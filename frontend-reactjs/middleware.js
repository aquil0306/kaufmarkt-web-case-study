// middleware.js
import { NextResponse } from "next/server";

const supportedLangs =
  process.env.NEXT_PUBLIC_SUPPORTED_LANGS_CODE
    ?.split(",")
    .map((code) => code.trim().toLowerCase()) || ["en"];

const defaultLangCode =
  process.env.NEXT_PUBLIC_DEFAULT_LANG_CODE?.trim().toLowerCase() ||
  supportedLangs[0];

export function middleware(request) {
  const url = request.nextUrl.clone();
  const searchParams = url.searchParams;
  const langParam = searchParams.get("lang")?.toLowerCase() || null;
  const cookieLang = request.cookies.get("lang")?.value?.toLowerCase() || null;

  const resolvedLang =
    langParam && supportedLangs.includes(langParam)
      ? langParam
      : cookieLang && supportedLangs.includes(cookieLang)
        ? cookieLang
        : defaultLangCode;

  // Canonical URL already has a supported lang — continue (refresh cookie).
  if (langParam && supportedLangs.includes(langParam)) {
    const response = NextResponse.next();
    response.cookies.set("lang", langParam, { path: "/" });
    return response;
  }

  // Missing ?lang= — resolve from cookie or default without an extra browser round-trip (no 307).
  if (!langParam) {
    const rewriteUrl = request.nextUrl.clone();
    rewriteUrl.searchParams.set("lang", resolvedLang);
    const response = NextResponse.rewrite(rewriteUrl);
    response.cookies.set("lang", resolvedLang, { path: "/" });
    return response;
  }

  // Invalid ?lang= — one redirect to a canonical query string (bookmark / bad link).
  const redirectUrl = request.nextUrl.clone();
  redirectUrl.searchParams.set("lang", resolvedLang);
  const response = NextResponse.redirect(redirectUrl);
  response.cookies.set("lang", resolvedLang, { path: "/" });
  return response;
}

export const config = {
  matcher: [
    "/",
    "/about-us",
    "/ad-details/:slug*",
    "/ad-listing",
    "/ads",
    "/blogs",
    "/blogs/:slug*",
    "/chat",
    "/contact-us",
    "/edit-listing/:id*",
    "/faqs",
    "/favorites",
    "/job-applications",
    "/landing",
    "/my-ads",
    "/my-listing/:slug*",
    "/notifications",
    "/privacy-policy",
    "/profile",
    "/refund-policy",
    "/reviews",
    "/seller/:id*",
    "/subscription",
    "/terms-and-condition",
    "/transactions",
    "/user-subscription",
    "/user-verification",
    // Exclude these
    "/((?!api|_next/static|_next/image|favicon.ico|firebase-messaging-sw.js).*)",
  ],
};

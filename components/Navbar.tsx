"use client";

import { useState } from "react";
import { Menu, X, Home as HomeIcon } from "lucide-react";

const navLinks = [
  { label: "Home", href: "#home" },
  { label: "Services", href: "#services" },
  { label: "Projects", href: "#projects" },
  { label: "About", href: "#about" },
  { label: "FAQ", href: "#faq" },
  { label: "Contact", href: "#quote" },
];

export default function Navbar() {
  const [mobileOpen, setMobileOpen] = useState(false);

  return (
    <header className="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16 md:h-20">
          {/* Logo */}
          <a href="#home" className="flex items-center gap-2.5 group">
            <div className="w-9 h-9 rounded-lg bg-brand-700 flex items-center justify-center">
              <HomeIcon className="w-5 h-5 text-white" strokeWidth={2.5} />
            </div>
            <div className="leading-tight">
              <span className="block text-sm font-bold text-brand-700 tracking-tight">
                Lawrence &amp; Sons
              </span>
              <span className="block text-[10px] font-medium text-gray-400 uppercase tracking-widest">
                Exterior Renovation
              </span>
            </div>
          </a>

          {/* Desktop nav */}
          <nav className="hidden md:flex items-center gap-1">
            {navLinks.map((link) => (
              <a
                key={link.href}
                href={link.href}
                className="px-3.5 py-2 text-sm font-medium text-gray-600 rounded-full hover:text-brand-700 hover:bg-brand-50 transition-colors"
              >
                {link.label}
              </a>
            ))}
            <a
              href="#quote"
              className="ml-3 inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-brand-700 rounded-full hover:bg-brand-800 transition-colors"
            >
              Get a Quote
            </a>
          </nav>

          {/* Mobile toggle */}
          <button
            onClick={() => setMobileOpen(!mobileOpen)}
            className="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors"
            aria-label={mobileOpen ? "Close menu" : "Open menu"}
          >
            {mobileOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </div>
      </div>

      {/* Mobile menu */}
      {mobileOpen && (
        <div className="md:hidden border-t border-gray-100 bg-white">
          <nav className="px-4 py-4 space-y-1">
            {navLinks.map((link) => (
              <a
                key={link.href}
                href={link.href}
                onClick={() => setMobileOpen(false)}
                className="block px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:text-brand-700 hover:bg-brand-50 transition-colors"
              >
                {link.label}
              </a>
            ))}
            <a
              href="#quote"
              onClick={() => setMobileOpen(false)}
              className="block mt-3 text-center px-5 py-2.5 text-sm font-semibold text-white bg-brand-700 rounded-full hover:bg-brand-800 transition-colors"
            >
              Get a Quote
            </a>
          </nav>
        </div>
      )}
    </header>
  );
}

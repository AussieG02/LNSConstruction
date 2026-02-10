import { Phone, Mail, MapPin, Home as HomeIcon } from "lucide-react";

const serviceLinks = [
  "Siding & Cladding",
  "Roofing & Gutters",
  "Windows & Doors",
  "Exterior Trim & Finishes",
  "Soffit & Fascia",
];

const companyLinks = ["About Us", "Our Projects", "Services", "FAQ", "Contact"];

export default function Footer() {
  return (
    <footer id="contact" className="bg-brand-950 text-gray-300">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
          {/* Brand */}
          <div>
            <div className="flex items-center gap-2.5 mb-5">
              <div className="w-9 h-9 rounded-lg bg-brand-700 flex items-center justify-center">
                <HomeIcon className="w-5 h-5 text-white" strokeWidth={2.5} />
              </div>
              <div className="leading-tight">
                <span className="block text-sm font-bold text-white tracking-tight">
                  Lawrence &amp; Sons
                </span>
                <span className="block text-[10px] font-medium text-gray-500 uppercase tracking-widest">
                  Exterior Renovation
                </span>
              </div>
            </div>
            <p className="text-sm leading-relaxed text-gray-400">
              Family-owned exterior renovation specialists. Trusted by
              homeowners for over 15 years to deliver quality siding, roofing,
              windows, and more.
            </p>
          </div>

          {/* Company */}
          <div>
            <h4 className="text-sm font-bold text-white uppercase tracking-wider mb-5">
              Company
            </h4>
            <ul className="space-y-3">
              {companyLinks.map((link) => (
                <li key={link}>
                  <a
                    href="#"
                    className="text-sm text-gray-400 hover:text-white transition-colors"
                  >
                    {link}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Services */}
          <div>
            <h4 className="text-sm font-bold text-white uppercase tracking-wider mb-5">
              Services
            </h4>
            <ul className="space-y-3">
              {serviceLinks.map((link) => (
                <li key={link}>
                  <a
                    href="#services"
                    className="text-sm text-gray-400 hover:text-white transition-colors"
                  >
                    {link}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h4 className="text-sm font-bold text-white uppercase tracking-wider mb-5">
              Contact Us
            </h4>
            <ul className="space-y-4">
              <li className="flex items-start gap-3">
                <Phone className="w-4 h-4 text-brand-400 mt-0.5 flex-shrink-0" />
                <span className="text-sm text-gray-400">(905) 555-0123</span>
              </li>
              <li className="flex items-start gap-3">
                <Mail className="w-4 h-4 text-brand-400 mt-0.5 flex-shrink-0" />
                <span className="text-sm text-gray-400">
                  info@lawrenceandsons.com
                </span>
              </li>
              <li className="flex items-start gap-3">
                <MapPin className="w-4 h-4 text-brand-400 mt-0.5 flex-shrink-0" />
                <span className="text-sm text-gray-400">
                  Serving the Greater Toronto Area
                  <br />
                  Oakville, Burlington, Mississauga &amp; beyond
                </span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      {/* Bottom bar */}
      <div className="border-t border-white/10">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
          <p className="text-xs text-gray-500">
            &copy; {new Date().getFullYear()} Lawrence &amp; Sons Exterior
            Renovation. All rights reserved.
          </p>
          <div className="flex gap-6">
            <a
              href="#"
              className="text-xs text-gray-500 hover:text-white transition-colors"
            >
              Privacy Policy
            </a>
            <a
              href="#"
              className="text-xs text-gray-500 hover:text-white transition-colors"
            >
              Terms of Service
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}

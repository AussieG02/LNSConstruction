import { ArrowRight, Play } from "lucide-react";

export default function Hero() {
  return (
    <section
      id="home"
      className="relative min-h-[600px] md:min-h-[700px] flex items-center"
    >
      {/* Background image */}
      <div
        className="absolute inset-0 bg-cover bg-center"
        style={{
          backgroundImage:
            "url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=80')",
        }}
      >
        <div className="absolute inset-0 bg-gradient-to-r from-brand-950/90 via-brand-900/70 to-brand-900/30" />
      </div>

      {/* Content */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-20 md:py-28">
        <div className="max-w-xl">
          <span className="inline-block px-4 py-1.5 mb-6 text-xs font-semibold tracking-widest text-brand-200 uppercase bg-white/10 rounded-full border border-white/20">
            Trusted Exterior Specialists
          </span>

          <h1 className="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.1] tracking-tight">
            BUILT RIGHT.
            <br />
            <span className="text-brand-300">EVERY TIME.</span>
          </h1>

          <p className="mt-6 text-base sm:text-lg text-gray-300 leading-relaxed max-w-md">
            Transform your home&#39;s exterior with expert craftsmanship.
            From siding and roofing to windows and doors — we deliver
            lasting durability and unmatched curb appeal.
          </p>

          <div className="mt-8 flex flex-wrap gap-4">
            <a
              href="#quote"
              className="inline-flex items-center gap-2 px-7 py-3.5 text-sm font-semibold text-white bg-brand-700 rounded-full hover:bg-brand-600 transition-colors shadow-lg shadow-brand-900/30"
            >
              GET A QUOTE
              <ArrowRight className="w-4 h-4" />
            </a>
            <a
              href="#projects"
              className="inline-flex items-center gap-2 px-7 py-3.5 text-sm font-semibold text-white border-2 border-white/30 rounded-full hover:bg-white/10 transition-colors"
            >
              <Play className="w-4 h-4" />
              VIEW PROJECTS
            </a>
          </div>

          {/* Stats row */}
          <div className="mt-12 flex gap-8 sm:gap-12">
            <div>
              <p className="text-2xl sm:text-3xl font-bold text-white">15+</p>
              <p className="text-xs text-gray-400 mt-1">Years Experience</p>
            </div>
            <div className="border-l border-white/20 pl-8 sm:pl-12">
              <p className="text-2xl sm:text-3xl font-bold text-white">500+</p>
              <p className="text-xs text-gray-400 mt-1">Projects Completed</p>
            </div>
            <div className="border-l border-white/20 pl-8 sm:pl-12">
              <p className="text-2xl sm:text-3xl font-bold text-white">100%</p>
              <p className="text-xs text-gray-400 mt-1">Satisfaction</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

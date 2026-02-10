import { ArrowRight, MapPin } from "lucide-react";
import Image from "next/image";

const projects = [
  {
    title: "Modern Siding Overhaul",
    location: "Oakville, ON",
    tag: "Siding",
    image:
      "https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&q=80",
  },
  {
    title: "Complete Roof Replacement",
    location: "Burlington, ON",
    tag: "Roofing",
    image:
      "https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80",
  },
  {
    title: "Window & Door Upgrade",
    location: "Mississauga, ON",
    tag: "Windows & Doors",
    image:
      "https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800&q=80",
  },
];

export default function Projects() {
  return (
    <section id="projects" className="py-20 md:py-28 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Heading */}
        <div className="text-center max-w-2xl mx-auto mb-14">
          <span className="inline-block px-4 py-1.5 mb-4 text-xs font-semibold tracking-widest text-brand-700 uppercase bg-brand-50 rounded-full">
            Our Work
          </span>
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">
            RECENT PROJECTS
          </h2>
          <p className="mt-4 text-gray-500 leading-relaxed">
            Browse our latest exterior renovation projects. Each one reflects
            our commitment to quality materials, precise craftsmanship, and
            homeowner satisfaction.
          </p>
        </div>

        {/* Project Grid */}
        <div className="grid md:grid-cols-3 gap-6 lg:gap-8">
          {projects.map((project) => (
            <div
              key={project.title}
              className="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300"
            >
              <div className="relative h-56 sm:h-64 overflow-hidden">
                <Image
                  src={project.image}
                  alt={project.title}
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-500"
                  sizes="(max-width: 768px) 100vw, 33vw"
                />
                <div className="absolute top-4 left-4">
                  <span className="inline-block px-3 py-1 text-xs font-semibold text-white bg-brand-700/90 backdrop-blur-sm rounded-full">
                    {project.tag}
                  </span>
                </div>
              </div>
              <div className="p-6">
                <h3 className="text-lg font-bold text-gray-900">
                  {project.title}
                </h3>
                <div className="mt-2 flex items-center gap-1.5 text-sm text-gray-400">
                  <MapPin className="w-3.5 h-3.5" />
                  {project.location}
                </div>
              </div>
            </div>
          ))}
        </div>

        {/* CTA */}
        <div className="text-center mt-12">
          <a
            href="#projects"
            className="inline-flex items-center gap-2 px-7 py-3.5 text-sm font-semibold text-white bg-brand-700 rounded-full hover:bg-brand-800 transition-colors"
          >
            EXPLORE OUR PROJECTS
            <ArrowRight className="w-4 h-4" />
          </a>
        </div>
      </div>
    </section>
  );
}

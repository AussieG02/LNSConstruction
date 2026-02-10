import Navbar from "@/components/Navbar";
import Hero from "@/components/Hero";
import InfoStrip from "@/components/InfoStrip";
import Services from "@/components/Services";
import Projects from "@/components/Projects";
import About from "@/components/About";
import WhyChoose from "@/components/WhyChoose";
import Partners from "@/components/Partners";
import QuoteForm from "@/components/QuoteForm";
import Footer from "@/components/Footer";

export default function Home() {
  return (
    <main>
      <Navbar />
      <Hero />
      <InfoStrip />
      <Services />
      <Projects />
      <About />
      <WhyChoose />
      <Partners />
      <QuoteForm />
      <Footer />
    </main>
  );
}

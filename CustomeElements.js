class SpecialHeader extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <nav class="TN-bar">
          <div class="S-logo">
            <img src="./Images/Logo/logo.png" alt="LOGO"/>
          </div>
  
          <div class="nav-items">
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="About.html">About us</a></li>
              <li><a href="services.html">Our Services</a></li>
              <li><a href="career.php">Careers</a></li>
              <li><a href="contact.php">Contact us</a></li>
            </ul>
          </div>
  
          <div class="burger">
            <img src="./Images/navigation/bars.png" alt="Navbar"/>
          </div>
        </nav>
      `;
    }
}

customElements.define('special-header', SpecialHeader);

class SpecialFooter extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <footer class="bfooter">
                <div class="top-footer">
                    <div class="foot footer1">
                        <div class="bf-header">
                            <h3>About</h3>
                        </div>
                        <div class="bf-content">
                            <p>At Vibo Aesthetics, we are dedicated to enhancing beauty and confidence through a personalized, patient-centric approach. Our motto Crafting Precision reflects comitment in delivering meticulous high quality results with tailored approuch.</p>
                        </div>
                    </div>
                    <div class="foot footer2">
                        <div class="bf-header">
                            <h3>Quick Links</h3>
                        </div>
                        <div class="bf-content">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="About.html">About Us</a></li>
                                <li><a href="services.html">Our Services</a></li>
                                <li><a href="career.php">Career</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="foot footer3">
                        <div class="bf-header">
                            <h3>Contact Info</h3>
                        </div>
                        <div class="bf-content">
                            <div class="bf-contact">
                                <i class="fa-solid fa-phone"></i> <p>+91-7997115999</p>
                            </div>
                            <div class="bf-contact">
                                <i class="fa-solid fa-envelope"></i> <p>info.sanvikasolutions@gmail.com</p>
                            </div>
                            <div class="bf-contact">
                                <i class="fa-solid fa-globe"></i> <p><a href="http://saanvikasolutions.com/">www.saanvikasolutions.com</a></p>
                            </div>
                            <div class="bf-contact">
                                <i class="fa-solid fa-location-dot"></i> <p>145, Rd Number 3, Kakatiya Hills, Guttala Begumpet, Kavuri Hills, Madhapur, Hyderabad, Telangana 500033</p>
                            </div>
                        </div>
                    </div>    
                    <div class="foot footer4">
                        <div class="bf-header">
                            <h3>Location</h3>
                        </div>
                        <div class="bf-content">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1903.1626148128496!2d78.400731!3d17.444141!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9142257dca53%3A0x623372a769444895!2s145%2C%20Rd%20Number%203%2C%20Kakatiya%20Hills%2C%20Guttala_Begumpet%2C%20Kavuri%20Hills%2C%20Madhapur%2C%20Hyderabad%2C%20Telangana%20500033%2C%20India!5e0!3m2!1sen!2sus!4v1711195913544!5m2!1sen!2sus" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="down-footer">
                    <p>Designed by <a href="#">&copySaanvika Software Solutions</a></p>
                </div>

            </footer>
        `
    }
}
customElements.define('special-footer', SpecialFooter);

class SpecialTestimonials extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <div class="container">

		<div class="contents-wraper">

			<section class="header">
				<h1>FROM OUR CLIENTS</h1>
			</section>

			<section class="testRow">

				<div class="testItem active">
					<img src="Images/testimonials/kripa.png">
					<h3>Kripa Designers</h3>
					<h4>Hyderabad, India</h4>
					<p>"Saanvika Software Solutions has excellently translated our unique clothing designs into an
						engaging website, showcasing our brand identity with precision. We appreciate their dedication
						to presenting our designs effectively on the digital stage at Kripa Designers."</p>
				</div>

				<div class="testItem">
					<img src="Images/testimonials/comaas.jpg">
					<h3>COMAAS Industries</h3>
					<h4>Korea</h4>
					<p>"Saanvika Software Solutions has significantly boosted our online presence through effective
						digital marketing strategies. Their crafted website perfectly embodies our brand identity. We're
						thankful for their exceptional services, which have greatly contributed to Comaas's digital
						success."</p>
				</div>

				<div class="testItem">
					<img src="Images/testimonials/Koradala-Naresh.png">
					<h3>Karadala Naresh</h3>
					<h4>BJP State member</h4>
					<p>"Saanvika Software Solutions has revolutionized our digital presence! Their digital marketing
						team orchestrated a campaign that not only boosted our online visibility but also significantly
						increased engagement. We couldn't be happler with the results"</p>
				</div>

				<div class="testItem">
					<img src="Images/testimonials/WhatsApp Image 2024-03-28 at 2.48.02 PM.jpeg">
					<h3>Sruthi Technologies</h3>
					<h4>Hyderabad, India</h4>
					<p>"Saanvika Software Solutions isn't just a service provider, they are strategic partners in our
						growth Journey. Their insights into our industry, coupled with their top-notch digital marketing
						and web development skills, have significantly contributed to our success."</p>
				</div>

				<div class="testItem">
					<img src="Images/testimonials/gcb.png">
					<h3>Gandhi Cooperative Bank</h3>
					<h4>Vijayawada, India</h4>
					<p>"I am extremely pleased with the services provided by Saanvika Software Solutions. Their
						expertise and dedication have significantly enhanced our operations at Gandhi Cooperative Bank."
					</p>
				</div>
				<div class="testItem">
					<img src="Images/testimonials/VDC logo (2) (1).png">
					<h3>Vivekananda Degree & PG College</h3>
					<h4>Hyderabad, India</h4>
					<p>"Saanvika Software Solutions crafted a stellar website for Vivekananda Degree & PG College,
						capturing our essence with precision. Their professionalism, prompt responses, and tailored
						approach ensured an outstanding online presence. Highly recommended!"</p>
				</div>
				<div class="testItem">
					<img src="Images/testimonials/Sanghamitra logo.png">
					<h3> Sanghamitra Degree & PG College</h3>
					<h4>Hyderabad, India</h4>
					<p>"Saanvika Software Solutions brilliantly transformed Sanghamitra Degree & PG College's online
						presence with an impeccably designed website. Their expertise and personalized approach
						perfectly showcased our institution's values. Highly impressed and recommended!"</p>
				</div>
				<div class="testItem">
					<img src="Images/testimonials/vis.jpg">
					<h3> Vivekananda International School</h3>
					<h4>Hyderabad, India</h4>
					<p>"Saanvika Software Solutions delivered an exceptional website for Vivekananda International
						School, capturing our ethos brilliantly. Their professionalism and tailored approach ensured a
						seamless process. Highly recommended for outstanding digital solutions!"</p>
				</div>
				<div class="testItem">
					<img src="Images/testimonials/ml.jpg">
					<h3> Dr. Madhavi Latha Kompella</h3>
					<h4>Hyderabad, India</h4>
					<p>"Madhavi Latha Kompella's campaign for Hyderabad Lok Sabha for BJP party was greatly bolstered by
						Saanvika Software Solutions' digital marketing expertise. From captivating flyers to engaging
						videos and adept social media management, their efforts significantly enhanced our outreach and
						impact. Grateful for their dedicated support in shaping our campaign's success."</p>
				</div>

			</section>

			<section class="indicators">
				<div class="dot active" attr='0' onclick="switchTest(this)"></div>
				<div class="dot" attr='1' onclick="switchTest(this)"></div>
				<div class="dot" attr='2' onclick="switchTest(this)"></div>
				<div class="dot" attr='3' onclick="switchTest(this)"></div>
				<div class="dot" attr='4' onclick="switchTest(this)"></div>
				<div class="dot" attr='5' onclick="switchTest(this)"></div>
				<div class="dot" attr='6' onclick="switchTest(this)"></div>
				<div class="dot" attr='7' onclick="switchTest(this)"></div>
				<div class="dot" attr='8' onclick="switchTest(this)"></div>
			</section>

		</div>
	</div>
        `
    }
}
customElements.define('special-testimonials', SpecialTestimonials);
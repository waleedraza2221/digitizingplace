<template>
     <v-app>
    <v-app-bar
      app
      color="white"
      height="100"
    >
      <v-avatar
        class="mr-3"
        color="grey lighten-5"
        size="70"
      >
        <v-img
          contain
          max-height="70%"
          src="https://digitizingplaceassets.s3.us-east-2.amazonaws.com/SoloS.png"
        ></v-img>
      </v-avatar>

      <v-toolbar-title class="font-weight-black headline">
        Digitizing Place
      </v-toolbar-title>
       <v-spacer></v-spacer>
   
    <v-tooltip bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn 
          class="ma-2"
          v-bind="attrs"
          v-on="on"
          link
          to="/getquote"
          outlined
          large
          fab
          color="indigo"
          >
        <v-icon>
          mdi-currency-usd
        </v-icon>
        </v-btn>
      </template>
      <span>Get Free Quote</span>
    </v-tooltip>
   
    <v-tooltip bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn 
          v-bind="attrs"
          v-on="on"
          link
          to="/client/login"
          outlined
          large
          fab
          color="indigo"
          >
        <v-icon>
          mdi-account
        </v-icon>
        </v-btn>
      </template>
      <span>Login/SignUp</span>
    </v-tooltip>
   

   

    </v-app-bar>

    <v-main>
      <section id="hero">
        <v-row no-gutters>
          <v-img
            :min-height="'calc(100vh - ' + $vuetify.application.top + 'px)'"
            src="https://digitizingplaceassets.s3.us-east-2.amazonaws.com/Background.png"
          >
            <v-theme-provider dark>
              <v-container fill-height>
                <v-row
                  align="center"
                  class="white--text mx-auto"
                  justify="center"
                >
                  <v-col
                    class="white--text text-center"
                    cols="12"
                    tag="h1"
                  >
                   

                  </v-col>

                  <v-btn
                    class="align-self-end"
                    x-large
                     color="warning"
                     outlined
                    @click="$vuetify.goTo('#contact')"
                  >
                    Get Free Quote / Estimates 
                  </v-btn>
                </v-row>
              </v-container>
            </v-theme-provider>
          </v-img>
        </v-row>
      </section>

      <section id="about-me">
        <div class="py-12"></div>

        <v-container class="text-center">
          <h2 class="display-2 font-weight-bold mb-3">About DIGITIZING PLACE</h2>

          <v-responsive
            class="mx-auto mb-8"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>

          <v-responsive
            class="mx-auto title font-weight-light mb-8"
            max-width="720"
          >
          Our great digitization administrations guarantee improved detail, less string dispersing, more clear plans and less material waste bringing about quicker creation. We work rapidly to meet our customers on schedule. 
          We have spent more then 15 years in this field and many Happy clients so we developed complete  portal to easily manage your designs. </v-responsive>

         <iframe width="560" height="315" src="https://www.youtube.com/embed/E5-IuSAqApc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <div></div>
        </v-container>

        <div class="py-12"></div>
      </section>

  <section id="statss">
        <v-parallax
          :height="$vuetify.breakpoint.smAndDown ? 700 : 500"
          src="https://digitizingplaceassets.s3.us-east-2.amazonaws.com/embroidery.png"
        >
     
        </v-parallax>
      </section>




<section id="Embroidery" class="grey lighten-3" >
        <div class="py-12"></div>

        <v-container class="text-center">
          <h2 class="display-2 font-weight-bold mb-3">Embroidery Digitizing</h2>

          <v-responsive
            class="mx-auto mb-8"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>

        <v-row>
          <v-col>
             <v-tabs vertical
              background-color="transparent">
      <v-tab>
        Digitizing Place Services
      </v-tab>
      <v-tab>
        Qualified Embroidery Digitizer
      </v-tab>
      <v-tab>
        Lowest Rates
      </v-tab>
         <v-tab>
        Online Embroidery Digitizing Services
      </v-tab>
      <v-tab>
        Quick Turnaround
      </v-tab>
      <v-tab>
        Left Chest Digitizing
      </v-tab>
       <v-tab>
        Pocket Embroidery Punch
      </v-tab>
        <v-tab>
        Cap Digitizing
      </v-tab>
       <v-tab>
        Hat Digitizing
      </v-tab>
       <v-tab>
        Jacket Back Digitizing
      </v-tab>
        <v-tab>
        Sleeve Digitizing
      </v-tab>
        <v-tab>
        Towel Punch Digitizing
      </v-tab>
      <v-tab>
        Gloves Digitizing
      </v-tab>
      <v-tab>
        Napkin Digitizing
      </v-tab>
      <v-tab>
        Beanies Digitizing
      </v-tab>
      <v-tab>
        Visor Embroidery Digitizing
      </v-tab>
      <v-tab>
        3d Puff Digitizing
      </v-tab>
       <v-tab>
        Logo Digitizing
      </v-tab>
        <v-tab>
        Custom Digitizing
      </v-tab>
         <v-tab>
        Patch Digitizing
      </v-tab>
         <v-tab>
        Applique Digitizing
      </v-tab>
         <v-tab>
        Letters / Font Digitizing
      </v-tab>
      <v-tab-item  
      background-color="transparent">
        <v-card flat >
          <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
             Digitizing Place, Based in Pakistan , Provices Great Embroidery Digitizing Services in best rates in the world. We don't charge based on stitched becasue that become costly more then you think.
             Our Flat rates would be best for you becasue your can get even 1Lac stitches in the price of 40$ Instead of 100$ which mostly other companies offer 
            </p>

            <p>
           Vector Digitizing Starts From 5$ to 60$ Max based on the design complexity, Which is lowest base price in market
            </p>

            <p class="mb-0">
           No Compromise On Quality We offer Free edits untill your satisfaction and Full Refund in case of dispute and offer 2 free designs in case of dispute
            </p>
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
           Our top rated embroidery digitizers in the PAK know the best ways to convert artwork into a vector art and how to digitize logo for embroidery machine without tampering or compromising with the original design during the process. Thanks to the expertise as well as innovative and creative abilities of each of our professional digitizer working in-house, you can get your custom artwork and embroidery logo digitizing into a machine ready file. Though we usually provide digitized files in the DST format, we can also provide them in EXP, EMB, CND, DSZ, DSB, KSM, XXX, T09, T05, T04, T03, T01, TAP, EMT, SEW, HUS, JEF, PCS, PCD, PES, PEC, CSD and PCQ formats in case our clients mention their specific needs while placing their orders.</p>

         

            <p class="mb-0">
        Whether you need embroidery digitization for tiny letters, digitizing for embroidery design for Puff and 3D effects or want vector art conversion to resize your image without distortion, our digitizing artwork for embroidery services can handle them all.   </p>
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
            We intend to revolutionize the digital world by providing the best conversion and digitized results with no compromise on rates. The following would give you an idea about how less you have to pay: </p>

            <p class="font-weight-light mb-10 text-center" >
          Fast Embroidery Digitizing Artwork done at low prices with no set up charges
          Get free estimates or place order by registering the account!
          Quick turnaround time within 24 hours. You do not have to worry about your Rush Jobs.
          Open 7 days a week.(24 Hours)
          Flat to cap and cap to flat conversion at low cost
          Moderate editing and machine format conversion are FREE
            </p>

    
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
          <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
           Converting the most intricate artwork with utmost precision and detail,
            affordable rates and timely delivery are our hallmarks, 
            which our customers love to talk about.
             With constantly updated technology and state of the art digitization software run by our skilled experts, 
             we help our clients stay ahead of the race, irrespective of whether they need embroidered uniforms, logos, or apparel.
              We can even digitize image for embroidery. With our diverse machine embroidery digitizing jobs that enable customization and conversion to the minutest detail, we ensure top-notch quality for every dime spent.
           </p>

    
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
  <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
        We help speed up your productivity by offering the quickest turnaround time of 24 hours, while a most jobs can be finished smoothly with in 8 to 24 hours with the perfection and eye on detail.
        Absolutely amazing digitised embroidery designs – is what our customers have to say.  </p>

    
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>


        <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
    We specialize in logo and small letter digitising. Left chest digitizing on your staff uniform is a great way of advertising and distinguishing your brand. If you are an emerging clothing brand, a coffee shop, a bakery or a pharmacy chain, you must ensure every worker gets a logo embroidered on their uniform. </p>

    
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

         <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
  Pocket digitising is the latest trend in small and medium businesses. We are expert digitisers having sound knowledge and vast experience of digitizing all sorts of logos for pockets. We offer the fastest turnaround time even for complex designs at affordable prices. Inquire today for an amazing and professional digitizing service.
     </p>

    
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
           <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
 Need cap digitization services? You have reached the right place because we are capable of providing you error free digitized files in a very short time. We completely understand how to digitise for caps as we have already delivered thousands of files. If you wish for flawless digitised designs, place your order today.   </p>

    
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

          <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
                We provide professional hat digitising services internationally. We are a leading company that excels in offering unblemished digitized files at throwaway prices. We have a team of experts with extensive hands-on experience and industry related background. Digitising for hats can be daunting and challenging but we handle it with care.
            </p>
    
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
             <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
           With a wide and ample space available to show our skills, we are sure to win your appreciation with our jacket back digitising service. Get your league name or any artwork digitized on the back of your jackets. We understand the intricacies of different kinds of jacket fabrics thus you don’t have to worry about anything. Just mention any special instructions and leave the rest to us. </p>
    
             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
            <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
          A new trend in the fashion industry and also the digitizing world. Your business logo gets one more place to shine through sleeve digitising. Machine embroidery can give you unlimited opportunities and we are here to help you try out new ways to explore branding or style. Let’s connect and get something awesome digitized today.
            
            </p> 
            </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
         <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
        Do you want Towel Punch done in a rush? We can give you high quality error free files ready to put up for production in your desired time. Our team of experts is available whenever you need digitizing services. Towel brands, hotels and spas can get their logos digitised for the perfect branding opportunity we make possible for your business.
            </p>
               </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
            <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
       Gloves digitisation is possible with our services and it gives your brand a new fashionable meaning. Your logo or design can be punched perfectly by our experts in any size for placement in any position. We deliver within the shortest possible time after ensuring our work is in total adherence to your given instructions.
            </p>
               </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

          <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
      Undoubtedly, one of the greatest need for hotels, bars, casinos, in short the hospitality industry is napkins digitisation. Owing to the small size and the fineness of the fabric, not every digitiser is able to punch embroidery for napkins. We are proud to say that we have the skills and expertise to give you the quality you need. Place your order today and let us give you something to be proud of.
            </p>
               </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
              <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
    Punch on Beanies is only possible by an expert who understands not only the software, but also the fabric properties. Without properly digitized files, it can be a mess on the production floor and our experience makes us the perfect choice for such a task. Get quality work without waiting for days, we deliver in 2 – 24 hours only.
           </p>
               </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
               <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
  Many digitisers claiming to be experts have failed at visor digitising but this is not the case with us. The extremely limited space and exact positioning is a huge challenge that can break digitizers. We are experts in visor embroidery punch and have already worked on hundreds of designs with success. We can give you that excellent result you are looking for.
           </p>
               </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

               <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
Your search for the perfect 3D Puff Digitising service ends here. We are pioneers and industry leaders with a long history of successful deliveries and happy customers. We have over 20 Wilcom and Pulse experts in our team, each of them having expertise in puff digitising. We use the latest technology to give you digitised files ready for production.         </p>
               </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
             <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
We can perfectly convert your artwork, logos and designs to machine ready files. We are experts in logo digitizing and even our customers are proud to endorse it. We work manually on all designs because we believe in delivering only the best quality. We will never send you anything that we can’t stitch ourselves.
</p>             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

     <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
Are you looking for a company that is affordable, delivers really quick and can fulfill your custom digitising needs? If your answer is ‘Yes’, then you don’t need to look any further. We have decades of experience in digitizing pictures for embroidery and have overcome every kind of challenge thrown at us. The years of experience has polished our skills that benefits our customers.</p>             </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

      
     <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
Patch digitisation is probably the commonest form of embroidery. But when given a professional touch by the experts, it can become a masterpiece in seconds. You don’t have to worry about the high prices to get our services because we are extremely affordable. Also, we have the shortest delivery time.
            </p>     
             </v-responsive>    
            </v-card-text>
        </v-card>
      </v-tab-item>



     <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
Adding appliques to your embroidery can be fun and rewarding at the same time. Our applique digitising service will give you the punched embroidery files that can stitch out the designs perfectly. Even if you are not going for commercial projects, we perfectly fit in your budget. Place your order with us and stitch beautiful designs.
        </p>
             </v-responsive>         
            </v-card-text>
        </v-card>
      </v-tab-item>

     <v-tab-item>
        <v-card flat>
              <v-card-text>
             <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
Some say you cannot get the perfect Monogram custom embroidery digitising services online these days. We don’t believe it because in all our years of professional working, we have never got any complaints in Monograming or Font Embroidery Punch. We use the latest technology to produce high quality files to digitalize embroidery manually. Because we don’t go for automated shortcuts, our work is free of all errors and you too will agree to it after giving us a try.        </p>         
             </v-responsive>  </v-card-text>
        </v-card>
      </v-tab-item>

    </v-tabs>
          </v-col>
        </v-row>

      
        </v-container>

        <div class="py-12"></div>
      </section>


     <section id="statss">
        <v-parallax
          :height="$vuetify.breakpoint.smAndDown ? 700 : 500"
          src="https://digitizingplaceassets.s3.us-east-2.amazonaws.com/Vector.png"
        >
          <v-container fill-height>
            <v-row class="mx-auto">
              <v-col
                v-for="[value, title] of stats"
                :key="title"
                cols="12"
                md="3"
              >
                <div class="text-center">
                  <div
                    class="display-3 font-weight-black mb-4"
                    v-text="value"
                  ></div>

                  <div
                    class="title font-weight-regular text-uppercase"
                    v-text="title"
                  ></div>
                </div>
              </v-col>
            </v-row>
          </v-container>
        </v-parallax>
      </section>



      <section
        id="features"
        class="lighten-3"
      >
        <div class="py-12"></div>

        <v-container class="text-center">
          <h2 class="display-2 font-weight-bold mb-3">Vector Tracing</h2>

          <v-responsive
            class="mx-auto mb-12"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>

          <v-row>
            <v-col>
           
   <v-tabs vertical>
      <v-tab>
        Vector Art Services
      </v-tab>
      <v-tab>
        Vector Conversion
      </v-tab>
      <v-tab>
        Raster to Vector Art
      </v-tab>
       <v-tab>
       Vectorizing
      </v-tab>
        <v-tab>
       Vectorization
      </v-tab>
            <v-tab>
       Vector Images Free
      </v-tab>
            <v-tab>
       Vector Art on Illustrator
      </v-tab>

           <v-tab>
      Convert a Logo to Vector
      </v-tab>

      <v-tab-item>
        <v-card flat>
          <v-card-text>
                      <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
           Vector art has an imperative role to play in marketing and branding a business. Not only vector art looks high quality, which encourages its use, the fact that it is scalable further acts as a fascinating prospect. Scalability means that vector graphics can be easily manipulated, re-sized and modified without distorting the image quality. But not all images are intrinsically vector artwork and this is where our raster to vector service comes in.
            </p>
                      </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text>
                      <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
          Raster is an image that is composed of numerous small rectangular or square elements called pixels. These pixels entail image details and together make up the raster. It will be wrong to say that raster images are of ‘poor-quality”. No, they are not and they have their own uses where they serve the purpose better than the vectors. But when we are considering use in promotional and branding material, vectors have no parallel to them.

When an image is in a bitmap or raster format like JPG, JPEG, BMP, GIF or PDF, it cannot be easily manipulated for use on a range of promotional materials. Pixels that formulate this image while resizing will be distorted, losing the crispiness of the graphic art. Consequently, these images render a blurred and jaggy outlook which obviously doesn’t look nice throughout your promotions.  </p>
                      </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

        <v-tab-item>
        <v-card flat>
          <v-card-text>
                      <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
              Our Vector Services can be used to convert a most complex raster to vector format like EPS, CDR or AI. It can be used for printing on T-shirts, caps, signboards or any promotional material. They can be easily resized, keeping the integrity of the artwork intact. With one suitable format, you can now replicate your business logos and graphics on almost anything.

Isn’t that amazing? It is but before you go any further, it is important to know that not all vectors are created equal. Like any skill, there are rookies, experienced and then the professionals.

For this truly great service, you are required to pay a pretty nominal fee. To your surprise, our professional vector services start at extremely low prices for artwork, logos and graphics. Don’t believe that you can get quality at cheap prices? Why not give it a shot? Get a quote today and we assure that you will not be disappointed.

Even after receiving your vector art, you can still ask for free edits. Yes, free edits to the first submission until you are completely satisfied. On top of it, all this is absolutely quick. With our absolutely amazing service, place your orders now and receive it in less than 24 hours.

A business logo says a lot about your company and plays a key role in corporate branding. Therefore, it is necessary to have a perfectly converted vector image of the same. This is where our raster to vector conversion services can help.

At Absolute Digitizing, we possess the most creative artists who are well versed in all perplexities of art forms to convert all your raster images into vector images. With adequate experience and expertise in converting JPEG, bitmap, GIF and other raster files into vector graphics quickly, these professionals can handle such conversions competently.

If you’ve been looking for quality raster to vector conversion services, your search ends here.
            </p>
          </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>


      
        <v-tab-item>
        <v-card flat>
          <v-card-text>
                      <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
              Vectorizing in short is the process of converting a raster image into a computer graphic which can be used in unusually small or large sizes. The advertisement industry needs graphic designers to do vectorizing for them so they can use an image in any size they want and fulfill their customer’s need.
            </p>
          </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

      <v-tab-item>
        <v-card flat>
          <v-card-text>
                      <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
           Since then, we have learned a lot and our experience now proves rewarding for our clients. Today, we have the best team of graphic designers in the Pakistan. Our excellent services have earned us appreciation from our customers. If you are looking for the best results within a budget, get a free quote now. </p>
          </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

       <v-tab-item>
        <v-card flat>
          <v-card-text>
                      <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
        We are a professional company that honors its clients beyond everything else. We take responsibility of our work and are committed to give you our 100%. If required, we can provide a rework on our delivered vector images free of any additional charges in case of any needed edits. Customer satisfaction is our top priority.
            </p>
              </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

             <v-tab-item>
        <v-card flat>
          <v-card-text>
                      <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
     We use the two major software of the graphics industry. Creating vector art on Illustrator by Adobe or using Corel Draw enables us to deliver our best. Since both these software are regularly updated, they help us to keep improving and as a result, our customers get the added benefit. We use the latest technology and up to date computer programs to do the required jobs.
           </p>
              </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

          <v-tab-item>
        <v-card flat>
          <v-card-text>
                      <v-responsive
            class=" title font-weight-light mb-8 text-left"
          >
            <p>
   Vector artwork is scalable and you can enlarge it to any extent without losing quality. As raster images are built out of pixels, they have a very limited flexibility. If you try to stretch a raster image to make it bigger than its actual size, or shrink it to make it small, you will notice that it  pixelates very quickly. Thus, it becomes impossible to use a raster image for promotional campaigns.       </p>
              </v-responsive>
          </v-card-text>
        </v-card>
      </v-tab-item>

    </v-tabs>


            </v-col>
          </v-row>
        </v-container>

        <div class="py-12"></div>
      </section>

 
      <section id="portfolio" class="grey lighten-3">
        <div class="py-12"></div>

        <v-container>
          <h2 class="display-2 font-weight-bold mb-3 text-uppercase text-center">Portfolio</h2>

          <v-responsive
            class="mx-auto mb-12"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>

          <v-row>
       
 <v-row>
    <v-col
      v-for="n in 9"
      :key="n+1"
      class="d-flex child-flex"
      cols="4"
    >
      <v-img
        :src="`https://digitizingplaceassets.s3.us-east-2.amazonaws.com/portfolio/A${n}.PNG`"
        :lazy-src="`https://digitizingplaceassets.s3.us-east-2.amazonaws.com/portfolio/A${n}.PNG`"
        aspect-ratio="1"
        class="grey lighten-2"
      >
        <template v-slot:placeholder>
          <v-row
            class="fill-height ma-0"
            align="center"
            justify="center"
          >
            <v-progress-circular
              indeterminate
              color="grey lighten-5"
            ></v-progress-circular>
          </v-row>
        </template>
      </v-img>
    </v-col>
  </v-row>




          </v-row>
        </v-container>

        <div class="py-12"></div>
      </section>

      <v-sheet
        id="contact"
        color="#333333"
        dark
        tag="section"
        tile
      >
        <div class="py-12"></div>

        <v-container>
          <h2 class="display-2 font-weight-bold mb-3 text-uppercase text-center">Get Free Quote</h2>

          <v-responsive
            class="mx-auto mb-12"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>
          Please Send your Files at admin@digitizingplace.com or Live Chat Us
 <!-- <v-form    
                ref="form"
                v-model="valid">
          <v-theme-provider light>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  flat
                  label="Name*"
                  solo
                   v-model="name"
                   :rules="nameRule"
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  flat
                  label="Email*"
                  solo
                   v-model="email"
                     :rules="emailRules"
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  flat
                  label="Phone*"
                   v-model="phone"
                  solo
                ></v-text-field>
              </v-col>


  <v-col cols="12">
                 <v-file-input
                 @change="changefile"
                :rules="filesRules"
                  v-model="files"
    counter
    label="Upload Your Files"
    multiple
    placeholder="*"
     filled
      background-color="white"
    prepend-icon="mdi-paperclip"
    :show-size="1000"></v-file-input>
                    </v-col>

              <v-col cols="12">
                <v-textarea
                  flat
                  aria-required
                  label="Description*"
                  :rules="descriptionRules"
                  v-model="description"
                  solo
                ></v-textarea>
              </v-col>

              <v-col
                class="mx-auto"
                cols="auto"
              >
                <v-btn
                  color="accent"
                  x-large
                  @click="upload"
                >
                  Get Quote
                </v-btn>
              </v-col>
            </v-row>
          </v-theme-provider>

 </v-form> -->
        </v-container>
<v-progress-linear
           :active=" loading"
           :indeterminate="loading"
            color="amber"
      
            rounded
            height="6"
          ></v-progress-linear>

             <v-snackbar v-model="snackbar" >
               {{text}}
                <v-btn
                  color="error"
                  text
                  @click="snackbar = false"
                >
                  Close
                </v-btn>
              </v-snackbar>  
        <div class="py-12"></div>
      </v-sheet>
    </v-main>

    <v-footer
      class="justify-center"
      color="#292929"
      height="100"
    >
      <div class="title font-weight-light grey--text text--lighten-1 text-center">
        &copy; {{ (new Date()).getFullYear() }} — Digitizing Place, Developed by <a href="https://www.fiverr.com/waleedraza2221">Waleed Raza</a>
      </div>
    </v-footer>
  </v-app>
</template>
<script>
export default{

     props: {
      source: String,
  
     
    },
    data: () => ({
      snackbar:false,
      drawer: null,
      loading:false,
       valid:true,
        name:'',
        email:'',
        phone:'',
        text:'',
       description:'',
       files:[],
        nameRule: [val => (val || '').length > 3 || 'Please Enter Valid Name'],
        emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
        descriptionRules: [
        v => !!v || 'Description is required',
        v => (v && v.length >= 5) || 'Description must be greater than 5 characters',
      ],
          filesRules:[
              v => !!v || 'Files are required',
          ]   


       
     
    }),
     methods:{
          changefile:function(e){
        //  console.log(e)
        this.files=[]
       let selectedFiles=e;
                if(!e.length){
                    return false;
                }
                for(let i=0;i<e.length;i++){
                    this.files.push(e[i]);
                }
               
  },

upload: function(){
        
        // Add a request interceptor
        axios.interceptors.request.use((config) => {
            this.loading = true;
            return config;
          },  (error) => {
            this.loading = false;
            return Promise.reject(error);
          });

        // Add a response interceptor
        axios.interceptors.response.use( (response) => {
           this.loading = false;
            return response;
          },  (error) => {
           this.loading = false
            return Promise.reject(error);
          });

 if( this.$refs.form.validate()){
        

       let formData = new FormData();
         for(let i=0; i<this.files.length;i++){
                  formData.append('sourcefiles[]',this.files[i]);
                }

       formData.append("description",this.description)
       formData.append("name",this.name)
       formData.append("email",this.email)
        formData.append("phone",this.phone)
       
     


          axios.put(this.$apipath+'quote', formData)
          .then(res =>  {
          console.log(res.message);
          snackbar=true;
            this.text ='Thanks for your query you will shortly get email for this';
             this.$refs.form.reset()
         
                    
          })
          .catch(err => {
            console.dir(err)
            snackbar=true;
             this.text = "Error Inserting Record Please send your design directly at admin@digitizingplace.com"
      
          })
        }

        
				
			}




     }
  
}
</script>
<style scoped>

</style>
<template>

	<div>
		<div class="page whiteBg" id="page-results">

			<div class="inner">

				<div id="results-intro">
					<img src="../img/headings/your-plan-header.png" alt="Your clean skin plan" id="title-your-plan">

					<div id="share-options">
						<div id="print" @click="printPage()">
							<img src="../img/icons/icon-print.png" alt="Print this"><span>Print</span>
						</div>

						<div id="email-self">
							<img src="../img/icons/icon-email.png" alt="Email this"><span>Email it to yourself</span>
						</div>
						
						<div id="email-self-form">
							<form id="email-form">
								<input type="text" placeholder="Email address" name="email" id="email" ref="emailInput" :disabled="emailSent">
								<input type="hidden" :value="dailyMatches" name="daily-matches" id="daily-matches">
								<input type="hidden" :value="weeklyMatches" name="weekly-matches" id="weekly-matches">
								<span class="email-button" @click="sendEmail()" ref="emailButton" v-show="!emailSent">Go</span>
							</form>

						</div>

						<p id="email-thanks" v-show="emailSent">Thank you - Your Clean Skin Plan has been emailed to you.</p>
					</div>

				</div>


				<div id="daily-wrapper">
					<div id="daily-header-line"></div>
					<div id="daily-header-block">For daily use</div>

						<app-daily-product v-for="(match, index) in dailyMatches">

							<p slot="name" class="product-name">{{ productData[match].name }}</p>
							<img :src="productData[match].image" slot="image">
							<p slot="blurb" class="product-blurb">{{ productData[match].blurb }}</p>
							<div slot="description" class="product-description" v-html="productData[match].description"></div>
							<div slot="howtouse"  class="product-how-to-use" v-html="productData[match].howtouse">{{ productData[match].howtouse }}</div>
							<p slot="whentouse" class="product-when-to-use">{{ productData[match].whentouse }}</p>
							<p slot="frequency" class="product-frequency">{{ productData[match].frequency }}</p>

							<a :href="productData[match].url" slot="url" class="shop-button" target="_blank">Shop now</a>

						</app-daily-product>
				</div>


				<div id="weekly-wrapper">
			
					<div id="weekly-header-line"></div>
					<div id="weekly-header-block">For weekly use</div>

					<app-weekly-product v-for="match in weeklyMatches">
						<p slot="name" class="product-name">{{ productData[match].name }}</p>
						<img :src="productData[match].image" slot="image">
						<p slot="blurb" class="product-blurb">{{ productData[match].blurb }}</p>
						<div slot="description" class="product-description" v-html="productData[match].description"></div>
						<div slot="howtouse"  class="product-how-to-use" v-html="productData[match].howtouse">{{ productData[match].howtouse }}</div>
						<p slot="whentouse" class="product-when-to-use">{{ productData[match].whentouse }}</p>
						<p slot="frequency" class="product-frequency">{{ productData[match].frequency }}</p>

						<a :href="productData[match].url" slot="url" class="shop-button" target="_blank">Shop now</a>
					</app-weekly-product>

				</div>
			</div>

		
		</div> <!-- page-results -->


		<div id="results-footer">
			<div class="inner">

				<div id="clean-face">
					<img src="../img/footer-woman.png" alt="Woman cleaning face">
				</div>

				<div id="clean-face-info">
					<img src="../img/headings/10-tips-clear-skin.png" alt="10 tips for clear skin">
					<p>Maintaining clean, healthy pores is important for sustaining healthy skin since the average adult has approximately 200,000 facial pores. Check out our handy little list of 10 tips for maintaining healthy and clean skin.</p>
					<a href="http://www.biore.co.uk/pore-care/" class="green-button" target="_blank">Click here</a>
					
				</div>

			</div>
		</div>


	</div>


</template>


<script>
  	import Products from '../json/product-data.json';
  	import DailyProduct from '../components/DailyProduct.vue';
  	import WeeklyProduct from '../components/WeeklyProduct.vue';

    //Dynamic product images
    import placeholder from '../img/products/product-placeholder.png';
    import product1 from '../img/products/baking-soda-anti-blemish-cleansing-foam.jpg';
    import product2 from '../img/products/baking-soda-cleansing-scrub.jpg';
    import product3 from '../img/products/baking-soda-pore-cleanser.jpg';
    import product4 from '../img/products/charcoal-anti-blemish-cleanser.jpg';
    import product5 from '../img/products/charcoal-antiblemish-scrub.jpg';
    import product6 from '../img/products/charcoal-minimiser-scrub.jpg';
    import product7 from '../img/products/charcoal-pore-strips.jpg';
    import product8 from '../img/products/charcoal-self-heating-one-minute-mask.jpg';
    import product9 from '../img/products/charcoal-soap-cleanser.jpg';
    import product10 from '../img/products/ultra-deep-cleansing-pore-strips.jpg';


    //Email 
    import footer from '../img/products/footer.jpg';
    import header from '../img/products/header.jpg';
    import shopnow from '../img/products/shopnow.gif';
    import dailyheader from '../img/products/dailyheader.gif';
    import weeklyheader from '../img/products/weeklyheader.gif';


	 import $ from 'jquery';

	export default {
		data () {
			return {
				dailyMatches: [],
				weeklyMatches: [],
				dailyProductIDs: [0, 3, 6, 7, 9, 11],
				weeklyProductIDs: [1, 2, 4, 5, 8, 10],
				productData: Products,
				emailSent: false
			}
		},

		created: function () {
			this.initialiseImages();
			this.finaliseSelections();
		},

		props: ['currentChoices', 'possibleOptions', 'userData'],

		components: {
			'app-daily-product': DailyProduct,
			'app-weekly-product': WeeklyProduct
		},

		mounted: function() {
		    gtag('event', 'Results viewed', {
		      'event_category': 'General'
		    });
		},

		methods: {

			//Add a prefixed path to images in the productData object.
			initialiseImages(){
	    		for(let i in this.productData) {   
			        this.productData[i].image = 'img/products/'+this.productData[i].image;
			    }
			},

			//Add product IDs to parent's data and move on to next question
			updateAndSwitchSection(optionArray) {
				this.$emit('addToSelection', optionArray);
				this.$emit('switchSection', 'app-question4');
			},

			//Search through currentChoices array, see if it matches a possibleOptions item, and add it to a new array.
			finaliseSelections() {

			    let initialMatches = [];
			    for(let i in this.currentChoices) {   
			        if(this.possibleOptions.indexOf(this.currentChoices[i]) > -1){ 
			            initialMatches.push(this.currentChoices[i]);
			        }
			    }

			    //Get daily matches
			    for(let j in initialMatches) {   
			        if(this.dailyProductIDs.indexOf(initialMatches[j]) > -1){ 
			            this.dailyMatches.push(initialMatches[j]);
			        }
			    }

			    //Get weekly matches
			    for(let k in initialMatches) {   
			        if(this.weeklyProductIDs.indexOf(initialMatches[k]) > -1){ 
			            this.weeklyMatches.push(initialMatches[k]);
			        }
			    }


			},

			//Open print page dialog.
			printPage() {
			    gtag('event', 'Skin Plan Printed', {
				      'event_category': 'General'
				});
				window.print();
			},

			//Ajax for posting to email.php (which generates the email template and sends it out)
			sendEmail() {
				if(this.$refs.emailInput.value.length < 6){
					return;
				}
			    gtag('event', 'Skin Plan Emailed', {
						      'event_category': 'General'
				});

				const appData = this;
		        $.ajax({
		            url:'api/email.php',
		            type:'post',
		            data:$('#email-form').serialize(),
		            dataType: "json",
		            success:function(response){
		                if (response['feedback']==="") {
		                 //all good
		                	appData.emailSent = true;
			
		                } else {
		                  //error
		                 appData.emailSent = false;
		                }
		            },
		            error:function(response){
		              appData.emailSent = true;
		            } 
		        });
			},
		}

	}


</script>



<style lang="scss" scoped>
  @import '../css/styles.scss';	


#results-intro {
  width:100%;
  text-align:center;
}

#title-your-plan {
  margin-top:30px;
  margin-bottom:10px;
  @include min-em(650) {
    margin-bottom:30px;
    margin-top:0;
  }
}

#share-options {
  width:100%;
  margin-bottom:40px;
  @include min-em(650) {
    width:600px;
    display: inline-block;
  }

  #print {
    width:100%;
    margin-bottom:10px;
    @include min-em(650) {
      width:105px;
      float:left;
      margin-bottom:0;
    }

    span {
      font-family:'ArcherProSemiBold';
      color:$darkBlue;
      padding-left:5px;
    }

  }

  #email-self {
    width:100%;
    margin-bottom:10px;
    @include min-em(650) {
      width:190px;
      float:left;
      margin-bottom:0px;
    }    

    span {
      font-family:'ArcherProSemiBold';
      color:$darkBlue;
      padding-left:5px;
    }
  }

  #email-self-form {

    @include min-em(650) {
      width:300px;
      float:left;
    }

    input {
      border: 2px solid $darkBlue;
      padding:5px 10px;
      width: 250px;
      box-sizing: border-box;
    }

    input[disabled="disabled"] {
      opacity: 0.3;
    }

    span.email-button {
      background-color:$darkBlue;
      color:#fff;
      border:none;
      padding:5px 10px;
      transition: background-color 0.5s;

      &:hover {
        background-color:lighten($darkBlue, 20%);
      }

    }
  }

}


#email-thanks {
  font-weight:bold;
  margin-top:20px; 
  width: 100%;
  display: inline-block;
  color:$hotPink;
}

#daily-header-line {
  width:100%;
  height:2px;
  background-color:$green;
}

#daily-header-block {
  background-color:$green;
  padding: 10px 0px;
  color:#fff;
  margin: -20px auto 35px auto;
  text-align:center;
  font-family:'ArcherProSemiBold';
  font-size:22px;  
  width:225px;
  @include min-em(400) {
    width:275px;
    margin: -20px auto 50px auto;
  }
}

#weekly-header-line {
  width:100%;
  height:2px;
  background-color:$hotPink;
}

#weekly-header-block {
  background-color:$hotPink;
  padding: 10px 0px;
  color:#fff;
  margin: -20px auto 35px auto;
  text-align:center;
  font-family:'ArcherProSemiBold';
  font-size:22px;

  width:225px;
  @include min-em(400) {
    width:275px;
    margin: -20px auto 50px auto;
  }
}




#results-footer {
  background-color: $darkBlue;
  width:100%;
  text-align:center;
  padding-bottom: 60px;
  padding-top:30px;

  @include min-em(550) {
    padding-bottom: 150px;
    padding-top:50px;
  }

}

#clean-face {
  width:100%;
  @include min-em(550) {
    width:30%;
    margin-right:5%;
    float:left;
  }
}


#clean-face-info {

  width:100%;
  @include min-em(550) {
    width:65%;
    float:left;
  }

  img {
    margin-top:30px; 
    @include min-em(550) {
      margin-top:0;
    }
  }

  p {
    color:#fff;
    margin-top:25px;
    margin-bottom:30px;
  }
}

.green-button {
  color:#fff;
  text-decoration:none;
  padding:10px 30px;
  background-color:$green;
  font-family: 'ArcherProSemiBold', Arial;
  font-size:19px;
  transition: background-color 0.5s;
    &:hover {
    background-color:lighten($green, 10%);
  }
}

@media print {
  #share-options, #results-footer, .shop-button {
    display:none;
  }

  #results-intro {
    text-align:left;
  }

  #title-your-plan {
    width:300px;
    text-align:left;
  }

  .product {
    margin-bottom: 15px;
  }
  .product img {
    width:100px;
    height:auto;

  }

  #weekly-header-block, #daily-header-block {
    text-align:left;
    margin: 0 !important;
  }
}


</style>
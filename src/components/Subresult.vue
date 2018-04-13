<template>
	<div class="page lightBgSolid" id="page-subresults">

			<div class="inner">

				<h1>Your skin type is:</h1>

				<p id="combination-skin" v-show="skinType=='combination'">Combination skin</p>
				<p id="oily-skin" v-show="skinType=='oily'">Oily skin</p>

				<div class="half">

					<div id="combination-skin-details" v-show="skinType=='combination'">
						<p>It looks like you have combination skin. You probably have an oily T-zone (your forehead, nose &amp; chin) and dry cheeks. You are most probably aware of the eternal combination skin conundrum:  how do you keep your T-zone clear of enlarged pores and breakthrough shine without encouraging dryness and flakiness elsewhere? The answer: Bioré Baking Soda products!</p>

						<p class="why">Why baking soda?</p>

						<p>Baking Soda is a gentle exfoliant found in nature - but on its own, natural baking soda is an alkaline that can dry the skin. Therefore, Bioré Baking Soda products are developed with natural baking soda and our Skin Purifying Technology to gently exfoliate and cleanse -  without damaging your skin. They help to reduce pore clogs and breakthrough shine in your t-zone area without encouraging dryness and flakiness elsewhere on your face.</p>

					</div>


					<div id="oily-skin-details" v-show="skinType=='oily'">
	
						<p>It looks like you have normal to oily skin. You probably notice excess shine on your face, even though you washed it only a couple of hours ago. You need products that will gently remove any excess oil without over-drying your skin and sending it into a vicious cycle of oil over-production.</p>


						<p class="why">Why charcoal?</p>

						<p>Charcoal is a powerful natural ingredient known for its ability to absorb oil and impurities. Bioré charcoal products, with natural charcoal and Skin Purifying Technology work like a magnet to draw out pore-clogging dirt and give oily skin a deep clean - without over-drying.</p>
					</div>

				</div>


				<div class="half">
					<img src="../img/white-splat-products.png" alt="Products" ref="productSet1" class="product-splat"  v-show="skinType=='combination'">
					<img src="../img/black-splat-products.png" alt="Products" ref="productSet2" class="product-splat"  v-show="skinType=='oily'">
				</div>

				

				<div class="buttons">
					<div class="half">
						<button @click="switchSection('app-landing')">&lt; Start over</button>
					</div>

					<div class="half">
						<button @click="switchSection('app-question2')">Continue &gt;</button>
						
					</div>
				</div>

			</div>
	
	</div>
</template>


<script>
	export default {
		props: ['skinType'],
		methods: {
			//Add product IDs to parent's data and move on to next question
			switchSection(next) {
				this.$emit('switchSection', next);
			}
		},

		mounted: function() {
			//Only 1 product-set image is shown at a time, but set animations for both of them.
			const productSet1 = this.$refs.productSet1;
			const productSet2 = this.$refs.productSet2;

			setTimeout(() => { 
				productSet1.className += " animate";
				productSet2.className += " animate";
			}, 100);

		},

	}
</script>


<style lang="scss" scoped>
  @import '../css/styles.scss'; 


#page-subresults {

  .inner {
    @include min-em(600) {
      padding-bottom:150px;
    }
  }

  h1 {
    text-align:center;
    font-family:'ArcherProSemiBold';
    font-size:25px;
    margin-bottom:5px;
  }

  #combination-skin, #oily-skin {
    text-align:center;
    color:#fff;
    font-family:'TrashHand', Serif;
    font-size:40px; 
    margin-top:0;  
    margin-bottom:30px;
  }

  #combination-skin-details p, #oily-skin-details p {
    color:#fff;
    font-size:16px;
    margin-top:0;
    box-sizing:border-box;
    padding-right:15px;
  }

  #combination-skin-details p.why,  #oily-skin-details p.why {
    color:#000;
    font-family:'TrashHand', Serif;
    font-size:30px; 
    margin-bottom:5px;
    margin-top:20px;
  }

  .product-splat {

    @include min-em(1385) {
      max-width:inherit;
      margin-top:-100px;
    }


    transition:transform 1s, opacity 1s; 

      /*Animation*/
      @include min-em(700) {  
        transform: translateY(20px);
        opacity:0;
      } 

      &.animate {
        @include min-em(700) {   
        transform: translateX(0px);
         opacity:1;
        }
      }

  }

  .buttons {
    width:100%;
    display:inline-block;
    margin-top:20px;    

    .half:first-child {
      text-align:center;
       @include min-em(600) {
        text-align:right;
       }

      button {
        background-color:$darkBlue;
        color:#fff;
        border:none;
        padding:10px 30px;
        font-family:'ArcherProSemiBold';
        font-size:20px;
        margin-bottom:20px;
        transition: background-color 0.5s;

        &:hover {
          background-color:lighten($darkBlue, 20%);
        }

        @include min-em(600) {
            margin-right:20px;
            margin-bottom:0;
        }

      }
    }

    .half:last-child {
      text-align:center;
      @include min-em(600) {
        text-align:left;
       }

      button {
        background-color:$darkBlue;
        color:#fff;
        border:none;
        padding:10px 30px;    
        font-family:'ArcherProSemiBold';
        font-size:20px;
        transition: background-color 0.5s;

        &:hover {
          background-color:lighten($darkBlue, 20%);
        }
        @include min-em(600) {
            margin-left:20px;
        }
      }
      
    }
  }
}
</style>
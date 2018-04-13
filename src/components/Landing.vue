<template>


	<div class="page lightBg" id="page-landing">

			<div class="inner">

				<div class="half">
					
					<img src="../img/cards/card-start.png" alt="Card start"  id="start-card" ref="startCard" v-on:click="$emit('switchSection', 'app-question1')">
				</div>


				<div class="half">
					<img src="../img/headings/create-your-plan-header.png" alt="Card start" id="landing-header">
					<p>Healthy skin starts with clean pores!</p>
					<p>But with a myriad of products out there, choosing the right one for you can be daunting. But don’t worry! Bioré are here to help.</p>
					<p>You are just a few minutes away from understanding which Bioré products are right for your skin.</p>
					<img src="../img/product-cluster.png" alt="Product Cluster" id="landing-cluster">	
				</div>


			</div>

	
	</div>




</template>


<script>
	export default {
		created: function () {
			this.$emit('resetData');
		},
		mounted: function() {
			const startCard = this.$refs.startCard;

			setTimeout(() => { 
				startCard.className = "animate";
			}, 100);

		},
	}
</script>

<style lang="scss" scoped>
  @import '../css/styles.scss';


	/* Landing Page */
	#page-landing {

	  .inner .half:last-child {
	    padding-left:0%;
	    box-sizing:border-box;

	    @include min-em(600) {   
	      padding-left:5%;
	    }
	  }

	  #start-card {
	    margin-top:20px;
	    margin-bottom:30px;
	    transition:transform 2s, opacity 2s; 

	    @include min-em(600) {
	      margin-bottom:0;
	    }


	    /*Animation*/
	    @include min-em(700) {  
	      transform: translateY(45px);
	      opacity:0;
	    } 

	    &.animate {
	      @include min-em(700) {   
	       transform: translateY(-10px);
	       opacity:1;
	      }
	    }

	    &:hover {
	      @include min-em(700) {   
	       transform: translateY(-20px);
	      }
	    }
	    /*********/
	  }


	  p {
	    color:#fff;
	    margin-top:0px;
	    margin-bottom:12px;
	  }

	  #landing-header {
	    margin-bottom:30px;
	  }

	  #landing-cluster {
	    margin-top:20px;
	  }

	}

</style>
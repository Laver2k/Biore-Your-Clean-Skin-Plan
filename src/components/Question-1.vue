<template>



	<div class="page whiteBg" id="page-q1">

			<div class="inner">
				<h1>First, let's find out what skin type you have?</h1>

				<div class="half left">
					<img src="../img/cards/card-oily.png" alt="Oily Skin" ref="leftCard" @click="updateAndSwitchSection(option1Products, 'oily')">
				</div>


				<div class="half right">
					<img src="../img/cards/card-oily-t.png" alt="Oily t-zone" ref="rightCard" @click="updateAndSwitchSection(option2Products, 'combination')">
				</div>


			</div>

	
	</div>



</template>

<script>
	export default {
		data () {
			return {
				option1Products: [0, 1, 2, 3, 4, 5 ], //6 is Micella water - unreleased product
				option2Products: [7, 8, 9, 10], //11 is Micella water - unreleased product
			}
		},
		methods: {
			//Add product IDs to parent's data and move on to next question
			updateAndSwitchSection(optionArray, skintype) {
				this.$emit('addToPossible', optionArray);
				this.$emit('setSkinType', skintype);
				this.$emit('switchSection', 'app-subresults');
			}
		},


		mounted: function() {

		    gtag('event', 'Question 1 viewed', {
		      'event_category': 'General'
		    });
    
			//Animate Cards
			const leftCard = this.$refs.leftCard;
			const rightCard = this.$refs.rightCard;

			setTimeout(() => { 
				leftCard.className = "animate";
				rightCard.className = "animate";
			}, 100);

		},

	}



</script>




<style lang="scss" scoped>
  @import '../css/styles.scss';
  @import '../css/questions.scss';
</style>


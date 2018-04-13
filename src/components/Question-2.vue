<template>

	<div class="page whiteBg" id="page-q2">

			<div class="inner">
				<h1>Do you suffer from or prone to spots and breakouts?</h1>

				<div class="half left">
					<img src="../img/cards/card-breakout.png" alt="Yes - Breakouts" ref="leftCard" @click="updateAndSwitchSection(option1Products)">
				</div>


				<div class="half right">
					<img src="../img/cards/card-breakout-no.png" alt="No breakouts" ref="rightCard" @click="updateAndSwitchSection(option2Products)">
				</div>


			</div>

	
	</div>



</template>


<script>
	export default {
		data () {
			return {
				option1Products: [0, 1, 2, 5, 7, 8, 10],
				option2Products: [2, 3, 4, 5, 8, 9, 10],
			}
		},
		methods: {
			//Add product IDs to parent's data and move on to next question
			updateAndSwitchSection(optionArray) {
				this.$emit('addToSelection', optionArray);
				this.$emit('switchSection', 'app-question3');
			}
		},

		mounted: function() {
			
		    gtag('event', 'Question 2 viewed', {
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
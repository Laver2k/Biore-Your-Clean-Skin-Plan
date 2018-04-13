<template>
	<div class="page whiteBg" id="page-q3">

			<div class="inner">
				<h1>Do you wear make-up?</h1>

				<div class="half left">
					<img src="../img/cards/card-makeup-yes.png" alt="Yes - Makeup" ref="leftCard" @click="updateAndSwitchSection(option1Products)">
				</div>


				<div class="half right">
					<img src="../img/cards/card-makeup-no.png" alt="No makeup" ref="rightCard" @click="updateAndSwitchSection(option2Products)">
				</div>


			</div>

	
	</div>
</template>


<script>
	export default {
		data () {
			return {
				option1Products: [6, 11],
				option2Products: [],
			}
		},
		methods: {
			//Add product IDs to parent's data and move on to next question
			updateAndSwitchSection(optionArray) {
				this.$emit('addToSelection', optionArray);
				this.$emit('switchSection', 'app-question4');
			}
		},

		mounted: function() {

		    gtag('event', 'Question 3 viewed', {
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
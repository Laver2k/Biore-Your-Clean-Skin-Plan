<template>




	<div class="page whiteBg" id="page-q4">

			<div class="inner">
				<h1>And finally, how old are you?</h1>
				
				<div id="circle-wrapper">
					<div class="circle" ref="circle1" @click="updateAge('Under 18')"><span>Under 18</span></div>
					<div class="circle" ref="circle2" @click="updateAge('18-24')"><span>18-24</span></div>
					<div class="circle" ref="circle3" @click="updateAge('25-34')"><span>25-34</span></div>
					<div class="circle" ref="circle4" @click="updateAge('35+')"><span>35+</span></div>
				</div>


			</div>

	
	</div>


</template>



<script>
	export default {
		data () {
			return {
				age: ''
			}

		},
		methods: {
			//Add age to parent's data and move on to next question
			updateAge(age) {
			    gtag('event', age, {
			      'event_category': 'Ages'
			    });
				this.$emit('updateAge', age);
				this.$emit('switchSection', 'app-results');
			}
		},


		mounted: function() {

		    gtag('event', 'Question 4 viewed', {
		      'event_category': 'General'
		    });
    
			//Animate Circles
			const circle1 = this.$refs.circle1;
			const circle2 = this.$refs.circle2;
			const circle3 = this.$refs.circle3;
			const circle4 = this.$refs.circle4;

			setTimeout(() => { 
				circle1.className += " animate";
			}, 200);

			setTimeout(() => { 
				circle2.className +=" animate";
			}, 400);

			setTimeout(() => { 
				circle3.className +=" animate";
			}, 600);

			setTimeout(() => { 
				circle4.className +=" animate";
			}, 800);

		},

	}


</script>


<style lang="scss" scoped>
  @import '../css/styles.scss';
  @import '../css/questions.scss';
</style>
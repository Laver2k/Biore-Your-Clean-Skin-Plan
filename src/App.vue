<template>
  <div id="app">

    <app-header></app-header>

    <transition name="fade" mode="out-in">

      <component 
        v-bind:is="currentSection" 
        v-on:switchSection="showSection($event)" 
        v-on:addToPossible="addToPossible($event)" 
        v-on:addToSelection="addToSelection($event)" 
        v-on:updateAge="updateAge($event)"
        v-on:resetData="resetData()" 

        v-on:setSkinType="setSkinType($event)" 

        :currentChoices="currentChoices"
        :possibleOptions="possibleOptions"
        :userData="userData"
        :skinType="skinType"
        ></component>

    </transition>

  </div>
</template>


<script>
  import AppHeader from './components/Header.vue'
  import Landing from './components/Landing.vue'
  import Results from './components/Results.vue'
  import Subresult from './components/Subresult.vue'
  import Question1 from './components/Question-1.vue'
  import Question2 from './components/Question-2.vue'
  import Question3 from './components/Question-3.vue'
  import Question4 from './components/Question-4.vue'
  
  import bgLight from './img/backgrounds/bubble-background-light.png';
  import bgDark from './img/backgrounds/bubble-background-dark.png';

  //Preload these images
  const preloadArray = [
    'img/black-splat-products.png',
    'img/backgrounds/bubble-background-dark.png',
    'img/backgrounds/bubble-background-light.png',
    'img/cards/card-breakout-no.png',
    'img/cards/card-breakout.png',
    'img/cards/card-makeup-no.png',
    'img/cards/card-makeup-yes.png',
    'img/cards/card-oily-t.png',
    'img/cards/card-oily.png',
    'img/white-splat-products.png',
    'img/headings/your-plan-header.png'
  ];
  preloadImages(preloadArray);

  //Takes an array of images and loads them into memory without displaying them.
  function preloadImages(imageArray){
    let arrayLength = imageArray.length;
    for (let i = 0; i < arrayLength; i++) {
      const image = new Image();
      image.src = imageArray[i];
    }
  }

export default {
  name: 'app',
  data () {
    return {
      currentSection: 'app-landing', //Dynamic component
      userData: {
        age: ''
      },
      skinType: '',
      currentChoices: [], //IDs of products that the user could be shown at the end
      possibleOptions: [], //IDs of products that the user CAN be shown at the end
    }
  },


  methods: {

    showSection(section) { //Switches the current 'section' using a dynamic component
      this.currentSection = section;
    },

    addToSelection(optionArray) {  //Add product IDs into the currentChoices data.
      for (let i = 0; i < optionArray.length; i++) {
        this.currentChoices.push(optionArray[i]);
      }
    },

    setSkinType(skinType) { //Set user's skin type.
      this.skinType = skinType;
    },

    addToPossible(optionArray) {    //Add product IDs into the possibleOptions data.
      for (let i = 0; i < optionArray.length; i++) {
        this.possibleOptions.push(optionArray[i]);
      }
    },

    updateAge(age) { //Set user's age.
      this.userData.age = age;
    },

    resetData() { //Reset all product IDs that have been accumulated.
      this.currentChoices = [];
      this.possibleOptions = [];
    },
  },


  components: {
    'app-header': AppHeader,
    'app-landing': Landing,
    'app-results': Results,
    'app-subresults': Subresult,
    'app-question1': Question1,
    'app-question2': Question2,
    'app-question3': Question3,
    'app-question4': Question4,

  }


}
</script>



<style lang="scss">
  @import 'css/styles.scss'
</style>



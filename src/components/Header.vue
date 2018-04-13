<template>
	<div id="header">
		<div class="section">

			<img src="../img/icons/logo.png" alt="Logo" id="logo-large">
			<img src="../img/icons/logo-mobile.png" alt="Logo" id="logo-small">

		</div>
	</div>
</template>


<style lang="scss" scoped>
  @import '../css/styles.scss';

	/* Header */
	#header {
	  width:100%;
	  background: $darkBlue  url('../img/backgrounds/headerBg.jpg')  no-repeat;
	  padding:10px 10px;
	  z-index:9;
	  box-sizing:border-box;
	  position: absolute;
	  @include min-em(650) {
	    height:105px;
	    padding:0;
	  }

	  #logo-small {
	    display:inline-block;
	    @include min-em(650) {
	      display:none;
	    }
	  }

	  #logo-large {
	    display:none;
	    @include min-em(650) {
	      display:inline-block;
	    }
	  
	  }
	}

</style>
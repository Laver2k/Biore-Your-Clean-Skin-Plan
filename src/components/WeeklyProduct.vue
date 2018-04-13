<template>
	<div class="product">

		<div class="product-image">
			<slot name="image"></slot>
		</div>


		<div class="product-details">
			<slot name="name"></slot>
			<slot name="blurb"></slot>
			<slot name="description"></slot>
			<p class="how-to-use">How to use</p>
			<slot name="howtouse"></slot>
			<p class="when-to-use">When to use</p>
			<slot name="whentouse"></slot>
			<slot name="url"></slot> 
		</div>

	</div>
</template>

<style lang="scss" scoped>
  @import '../css/styles.scss';	

	.product {
	  display:inline-block;
	  margin-bottom:55px; 

	  @include min-em(500) {
	  margin-bottom:65px;
	  }

	  a {
	    color:$green;
	    font-weight:bold;
	    text-decoration:none;
	    &:hover {
	      text-decoration:underline;
	    }
	  }
	}


	.product-image {
	  margin-bottom:20px;
	  @include min-em(600) {
	    width:30%;
	    margin-right:5%;
	    float:left;
	  }

	  img {
	    max-width:250px;
	  }
	}

	.product-details {
	  @include min-em(600) {
	    width:65%;
	    float:left;
	  }
	}

	.product-name {
	  color:$darkBlue;
	  font-family:'ArcherProSemiBold', Arial;
	  font-size:25px;
	  margin-top:0;
	  margin-bottom:5px;
	}

	.product-blurb {
	  margin-top:0;
	  margin-bottom:15px;
	  font-size:15px;
	  color:$darkBlue;
	  font-weight:bold;
	}

	.how-to-use {
	  margin-top:0;
	  margin-bottom:5px;
	  font-size:25px;
	  font-family:'TrashHand', Serif;
	}

	#daily-wrapper .how-to-use {
	  color:$green;
	}

	#weekly-wrapper .how-to-use {
	  color:$hotPink;
	}

	.product-how-to-use, .product-how-to-use p, .product-description, .product-description p{
	  margin-top:0;
	  margin-bottom:10px;
	  font-size:15px;
	  color:$darkBlue;
	}

	.product-description li {
	  margin-bottom:0px;

	}

	.product-how-to-use {
	  ul, ol {
	    margin-top:0;    
	    padding-left:15px;
	    li {
	      margin-bottom:5px;
	    }
	  } 
	}

	.when-to-use {
	  margin-top:0;
	  margin-bottom:5px;
	  font-size:25px;
	  font-family:'TrashHand', Serif;
	}

	#daily-wrapper .when-to-use {
	  color:$green;
	}

	#weekly-wrapper .when-to-use {
	  color:$hotPink;
	}

	.product-when-to-use {
	  margin-top:0;
	  margin-bottom:25px;
	  font-size:15px;
	  color:$darkBlue;
	}

	a.shop-button {
	  background-color:$darkBlue;
	  color:#fff;
	  border:none;
	  padding:10px 30px;
	  text-decoration:none;
	  font-family:'ArcherProSemiBold';
	  font-size:18px;
	  transition: background-color 0.5s;
	  font-weight:normal;
	  &:hover {
	    background-color:lighten($darkBlue, 20%);
	  }
	}
</style>
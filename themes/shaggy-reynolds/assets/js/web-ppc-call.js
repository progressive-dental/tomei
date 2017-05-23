// Copyright 2016 by Progressive Dental written by Thomas Pursifull
// Version 1.4 - 05/05/2017
// Dr. Nargiz Schmidt smileinthecity.com
/////////////////////////////////////////////////

function setAdStorage(docReferrer, urlQuery) {
	// Store
	if((!localStorage.getItem("fromAd")) || (localStorage.getItem("fromAd") == '0')){
	//alert('Setting Ad Storage');
	localStorage.setItem("Referrer", docReferrer + urlQuery);
	localStorage.setItem("fromAd", '1');
	//return true;
	}
}

function setOrganicStorage(docReferrer, urlQuery) {
	if(!localStorage.getItem("fromAd")){
	//alert('Setting Organic Storage');
	localStorage.setItem("Referrer", docReferrer + urlQuery);
	localStorage.setItem("fromAd", '0');
	//return true;
	}
}
	
function updateCallTracking(){
// Call display
var callDisplay = "Call ";
// set up two call numbers
var webCallTrackingNumber = document.querySelector('.clickToCall').dataset.callTrackingNumber;
var ppcCallTrackingNumber = document.querySelector('.clickToCall').dataset.ppcTrackingNumber
// Setup Click to call
var webClickToCall = "tel:+1" + document.querySelector('.clickToCall').dataset.callTrackingNumber.replace(/\D/g,'');
var ppcClickToCall = "tel:+1" + document.querySelector('.clickToCall').dataset.ppcTrackingNumber.replace(/\D/g,'');
// End of phone numbers
var docReferrer = document.referrer;
var urlQuery = location.search;
//alert('Thanks for visiting from ' + document.referrer + urlQuery);

if (document && document.getElementById) {
	
	if(localStorage.getItem("fromAd") == '1'){
		// get the array of items with a class of clickToCall
		var clickToCallTrackingNumber = document.getElementsByClassName("clickToCall");
		// set the length of this new array
		var clickToCallArrayLength = clickToCallTrackingNumber.length;
		// end of clickToCall variables
		// get the array of items with a class of number
		var displayCallTrackingNumber = document.getElementsByClassName("webPpcNumber");
		// set the length of this new array
		var arrayLength = displayCallTrackingNumber.length;
		//alert('You came from an ad');
		// update html phone display
		for (var i = 0; i < arrayLength; i++) {
		displayCallTrackingNumber[i].innerHTML = ppcCallTrackingNumber;
		//update numbers
		}
		// update click to call values
		for (var i = 0; i < clickToCallArrayLength; i++) {
		clickToCallTrackingNumber[i].href = ppcClickToCall;
		clickToCallTrackingNumber[i].title = callDisplay + ppcCallTrackingNumber;
		//update HTML href and title values
		}
	}
	if(localStorage.getItem("fromAd") == '0'){
		// get the array of items with a class of clickToCall
		var clickToCallTrackingNumber = document.getElementsByClassName("clickToCall");
		// set the length of this new array
		var clickToCallArrayLength = clickToCallTrackingNumber.length;
		// end of clickToCall variables
		// get the array of items with a class of number
		var displayCallTrackingNumber = document.getElementsByClassName("webPpcNumber");
		// set the length of this new array
		var arrayLength = displayCallTrackingNumber.length;
		//alert('You came from a organic link');
		
		for (var i = 0; i < arrayLength; i++) {
		displayCallTrackingNumber[i].innerHTML = webCallTrackingNumber;
		//update HTML href and title values
		}
		// update click to call values
		for (var i = 0; i < clickToCallArrayLength; i++) {
		clickToCallTrackingNumber[i].href = webClickToCall;
		clickToCallTrackingNumber[i].title = callDisplay + webCallTrackingNumber;
		//update HTML href and title values
		}
	}
	// check to see if we have just got to the page
	if((urlQuery.match("gclid")) || (urlQuery.match("utm_")) || (localStorage.getItem("fromAd") == '1')){
		// get the array of items with a class of clickToCall
		var clickToCallTrackingNumber = document.getElementsByClassName("clickToCall");
		// set the length of this new array
		var clickToCallArrayLength = clickToCallTrackingNumber.length;
		// end of clickToCall variables
		// get the array of items with a class of number
		var displayCallTrackingNumber = document.getElementsByClassName("webPpcNumber");
		// set the length of this new array
		var arrayLength = displayCallTrackingNumber.length;
		//alert('You came from an ad');
		// update click to call values
		for (var i = 0; i < clickToCallArrayLength; i++) {
		clickToCallTrackingNumber[i].href = ppcClickToCall;
		clickToCallTrackingNumber[i].title = callDisplay + ppcCallTrackingNumber;
		//update HTML href and title values
		}
		for (var i = 0; i < arrayLength; i++) {
		displayCallTrackingNumber[i].innerHTML = ppcCallTrackingNumber;
		//update numbers
		setAdStorage(docReferrer, urlQuery);
		} // end of loop
		
	} else {
		// get the array of items with a class of clickToCall
		var clickToCallTrackingNumber = document.getElementsByClassName("clickToCall");
		// set the length of this new array
		var clickToCallArrayLength = clickToCallTrackingNumber.length;
		// end of clickToCall variables
		// get the array of items with a class of number
		var displayCallTrackingNumber = document.getElementsByClassName("webPpcNumber");
		// set the length of this new array
		var arrayLength = displayCallTrackingNumber.length;
		//alert('You came from a organic link');
		// update click to call values
		for (var i = 0; i < clickToCallArrayLength; i++) {
		clickToCallTrackingNumber[i].href = webClickToCall;
		clickToCallTrackingNumber[i].title = callDisplay + webCallTrackingNumber;
		//update HTML href and title values
		}
		for (var i = 0; i < arrayLength; i++) {
		displayCallTrackingNumber[i].innerHTML = webCallTrackingNumber;
		//update numbers
		setOrganicStorage(docReferrer, urlQuery);
		} // end of loop
	} // end of else
  } // end of if
} // end of update numbers
window.onload = updateCallTracking();
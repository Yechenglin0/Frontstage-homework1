function translate() {

	if(arguments.length == 0) {
		console.log("input your words first");
	} else {
		for (var i = 0; i < arguments.length; i++) {
		
			if (arguments[i].substr(arguments[i].length-1,1) == "y") {
				arguments[i] = arguments[i].substring(0,arguments[i].length-1) + "ily";
			} else {
				arguments[i]+="ly";
			}
	
		}
		return arguments;
	}

}


translate("love","happy","vivid","tight","easy");
translate();

var arr = [123, "445", 2, "6", 434];
function sortToStr(arr) {
	for (var i = 0; i < arr.length; i++) {
		for (var j = 0; j < i; j++) {
			if (Number(arr[i]) > Number(arr[j])) {
				var t = Number(arr[i]);
				arr[i] = Number(arr[j]);
				arr[j] = t;
			}
		}
	}
	var res = "";
	for (i = 0; i < arr.length; i++ ) {
		res += String(arr[i]);
	}
	return res;
}
console.log(sortToStr(arr));

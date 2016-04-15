var arr = [13, 4, 25, 6, 123];
var method = "minus";
var num = 3;
function arrChange(method, num, arr) {
	for (var i in arr) {
		switch(method) {
			case "plus" : arr[i] += num; break;
			case "minus" : arr[i] -= num; break;
			case 'multiply' : arr[i] *= num; break;
			case 'divide' : 
				if (num==0) {
					console.log("除数不能为0");
				} else {
					arr[i] /= num; break;
				}
			default : console.log("错误的方法");
		}
	}
	for (var i in arr) {
		console.log(arr[i]);
	}
}


arrChange(method, num, arr);
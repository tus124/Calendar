	function removeSlashesorDashes(string, returnNoOfAttributes) {
		var result = "";
		var i = string.indexOf("/", 0);
		var j = string.indexOf("-", 0);

		if(i > 0 && i < j) {
			// there could be 1 or 2 slash eg:ab/cd - [hij] or abc/def/ghi - [jkl]
			var arr = string.split("/");
			if(arr.length > 2){
				//means there are 2 slash eg: ab/cd/ef - [hij]
				result = arr[0];
				for(var k=1; k<=returnNoOfAttributes; k++) {
					result += "/" + arr[k];
				}
			}else{
				// array len is 2 and there was 1 slash eg: ab/cd - [efi]
				result = arr[0];
			}
		}
		else {
			result = string.split("-")[0];
			for(var k=1; k<=returnNoOfAttributes; k++) {
				result += "-" + arr[k];
			}
		}
		return result;
	}
	
	
	function capitalize(string, a) {
        var tempstr = string.toLowerCase();
        if (a == false || a == undefined) {
            return tempstr.replace(tempstr[0], tempstr[0].toUpperCase());
        }else {
            return tempstr.split("_").map(function (i) { 
                return i[0].toUpperCase() + i.substring(1) 
            }).join(" ");
        }
    }
    
    function checkExceptions(key, exceptionList) {
        var found = false;
    	for(var i=0; i<exceptionList.length; i++) {
    	    if(key.toLowerCase() == exceptionList[i].toLowerCase()) {
    	        found = true;
    	        break;
    	    }
    	}
    	return found;
    }
	
	function createCORSRequest(method, url) {
	    var xhr = new XMLHttpRequest();
	    if ("withCredentials" in xhr) {
			// XHR for Chrome/Firefox/Opera/Safari.
			xhr.open(method, url, xhr.withCredentials);
	    }else if (typeof XDomainRequest != "undefined") {
			// XDomainRequest for IE.
			xhr = new XDomainRequest();
			xhr.open(method, url);
		}else {
		    // CORS not supported.
		    console.log("Cors not supported");
			xhr = null;
		}
		return xhr;
	}
	
	function sendEmail(email) {

		var res = {
			"Url"	   : email.Url		  ,
            "Host"     : email.Host       ,
            "From"     : email.From       ,
            "To"       : email.To         ,
            "Cc"       : email.Cc         , 
            "Subject"  : email.Subject    ,
            "Body"     : JSON.parse(email.Body)
        };


	    var xhr = createCORSRequest('POST', email.Url);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
			    console.log("Email has been send successfully. " +  xhr.responseText);
			}
		}
		xhr.onerror = function(e) {
		    alert("An error has occurred. Please contact your system administrator. " + e);
		}
		
		xhr.send( JSON.stringify(res) ); 
    }
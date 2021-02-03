
const urlParams = new URLSearchParams(window.location.search)
if (urlParams.get("token") != null)
    localStorage.setItem("token", urlParams.get("token"))

var config = {
    headers : {
        token: localStorage.getItem("token")
    }
}

document.documentElement.setAttribute("ng-app", "myApp")
var app = angular.module('myApp', []);
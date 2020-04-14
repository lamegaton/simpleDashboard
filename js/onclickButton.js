var addButtons = document.getElementsByClassName("addCase");
var removeButtons = document.getElementsByClassName("removeCase");

for (var i = 0; i <= removeButtons.length; i += 1) {
  removeButtons[i].onclick = function(e){
    if (confirm('Do you want to remove this case?')) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          location.reload(true);
        }
      };
      xhttp.open("POST", "removeCase.php",true);
      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttp.send('choice=' + this.id);
    }
  };
  addButtons[i].onclick = function(e){
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "passVal.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send('choice=' + this.id);
    location.href = "showCase.php";
  };
}
// for (var i = 0; i <= addButtons.length; i += 1) {
//     addButtons[i].onclick = function(e){
//       alert(this.id);
//       var xhttp_add = new XMLHttpRequest();
//       xhttp_add.open("POST", "passVal.php", true);
//       xhttp_add.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//       xhttp_add.send('choice=' + this.id);
//       location.href = "showCase.php";
//     };
// }

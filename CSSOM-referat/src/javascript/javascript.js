function openNavigation() {
    document.getElementById("side_navigation").style.width = "30%";
    document.getElementById("content").style.marginLeft = "30%";
    document.getElementById("head").style.marginLeft = "30%";
    document.getElementById("resources_container").style.marginLeft = "30%";
  }
  
  function closeNavigation() {
    document.getElementById("side_navigation").style.width = "0";
    document.getElementById("content").style.marginLeft = "15%";
    document.getElementById("head").style.marginLeft = "0";
    document.getElementById("resources_container").style.marginLeft = "15%";
  }
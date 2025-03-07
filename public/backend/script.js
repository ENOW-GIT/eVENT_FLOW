document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("search").addEventListener("click", function() {
      let input = document.getElementById("search-input").value.toLowerCase();
      let eventItems = document.getElementsByClassName("event-item");

      for (let i = 0; i < eventItems.length; i++) {
          let item = eventItems[i];
          let textContent = item.textContent.toLowerCase();
          
          if (textContent.includes(input)) {
              item.style.display = "";
          } else {
              item.style.display = "none";
          }
      }
  });
});


// getting data for new events
async function getRecipes(){
   
}

async function init(){
  const recipes = await getRecipes()

}




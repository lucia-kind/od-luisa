       var likedNames = [],
           dislikedNames = [];



       function onSwipeLuisa(options) {
           //Zähler einbauen

           if (options == "left") {

               var aktuelleNamen = "hallo"; /*document.getElementsByClassName('name');*/
               //falls weniger als 5 namen in liste lade neue namen
               //sonst lösche name

               dislikedNames.push(aktuelleNamen);
               console.log(dislikedNames);
           } else if (options == "right") {
               likedNames.push(document.getElementsByClassName('name').id);
               console.log(likedNames);
           }
       }
       //vermutlich sind alle Zettel mit einem p tag mit der id name versehen und er nimmt dne ersten Wert
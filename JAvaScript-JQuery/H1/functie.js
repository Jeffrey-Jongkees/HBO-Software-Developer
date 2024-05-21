function toonVersie(){
    
    const tekst = 'U gebruikt ' + navigator.appName + ', ' + 'versie: ' + navigator.appVersion;
    document.getElementById('divResult').innerHTML = tekst;
}
        
const person = {
    firstName:"John",
    lastName:"Doe",
    age:50, eyeColor:"blue"
  }
  
  const x = person;
  x.age = 10;
  x.eyeColor = 'red' 

  console.log(person, x)
function stringsAanElkaarPlakken() {
    const string1 = 'Hoi';
    const string2 = 'ik ben';
    const string3 = 'Jeffrey';

    const tekst = string1 + ' ' + string2 + ' ' + string3 

    document.getElementById('divResult').innerHTML = tekst;

    console.log(string1, string2, string3)
}
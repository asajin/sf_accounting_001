function createPriceList(count) {
    
var firstNames = ["Nancy", "Andrew", "Janet", "Margaret", "Steven", "Michael", "Robert", "Laura", "Anne", "Nige"],
    lastNames = ["Davolio", "Fuller", "Leverling", "Peacock", "Buchanan", "Suyama", "King", "Callahan", "Dodsworth", "White"],
    cities = ["Seattle", "Tacoma", "Kirkland", "Redmond", "London", "Philadelphia", "New York", "Seattle", "London", "Boston"],
    titles = ["Accountant", "Vice President, Sales", "Sales Representative", "Technical Support", "Sales Manager", "Web Designer",
    "Software Developer", "Inside Sales Coordinator", "Chief Techical Officer", "Chief Execute Officer"],
    birthDates = [new Date("1948/12/08"), new Date("1952/02/19"), new Date("1963/08/30"), new Date("1937/09/19"), new Date("1955/03/04"), new Date("1963/07/02"), new Date("1960/05/29"), new Date("1958/01/09"), new Date("1966/01/27"), new Date("1966/03/27")],
    unitsList = ['l','un','m','ml','g','mg'],
    pricesList = [12.34,23.43,12.12,32.87,16.32,28.43,17.76,37,84,95],
    stockList = [34,23,12,76,34,56,15,37,84,95];

    var data = [],
        now = new Date();
    for (var i = 0; i < count; i++) {
        var firstName = firstNames[Math.floor(Math.random() * firstNames.length)],
            unitRandom = unitsList[Math.floor(Math.random() * unitsList.length)],
            priceRandom = pricesList[Math.floor(Math.random() * pricesList.length)],
            stockRandom = stockList[Math.floor(Math.random() * stockList.length)];

        data.push({
            id: i + 1,
            code: '1000'+i,
            name: firstName,
            units: unitRandom,
            price: priceRandom,
            stock: stockRandom
        });
    }
    return data;
}
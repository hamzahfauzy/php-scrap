var request = require("request");
const fs = require('fs');

let rawdata = fs.readFileSync('subdistricts.json');
let subdistricts = JSON.parse(rawdata);
subdistricts = subdistricts.slice(0,2);
var asal = [{id:4891,name:"Kalideres"},{id:2089,name:"Pekalongan"}]
var couriers = [
    "jne", "pos", "tiki", "rpx", "esl", 
    "pcp", "pandu", "wahana", "sicepat", "jnt", 
    "pahala", "cahaya", "sap", "jet", "dse", 
    "slis", "first", "ncs", "star", "ninja", 
    "lion", "idl", "rex"
]

// console.log(couriers)

for(i=0;i<asal.length;i++)
{
	var _asal = asal[i];
	for(j=0;j<subdistricts.length;j++)
	{
		var subdistrict = subdistricts[j]
		// var costs = []
		for(k=0;k<couriers.length;k++)
		{
			var options = {
				method: 'POST',
				url: 'https://pro.rajaongkir.com/api/cost',
				headers: {key: '28200787cde4f092e544c66f4d131080', 'content-type': 'application/x-www-form-urlencoded'},
				form: {
			    	origin: _asal.id,
			    	originType: 'subdistrict',
			    	destination: subdistrict.subdistrict_id,
			    	destinationType: 'subdistrict',
			    	weight: 1000,
			    	courier: couriers[k]
				}
			};

			var req = await request(options)
			console.log(req)
			// request(options, function (error, response, body) {
			// 	if (error) throw new Error(error);
			// 	// let data = JSON.stringify(body);
			// 	fs.writeFileSync('node/'+_asal.id+'-'+_asal.name+'-'+subdistrict.subdistrict_id+'-'+subdistrict.subdistrict_name+'-'+couriers[k]+'.json', body);
			// });
		}
	}
}
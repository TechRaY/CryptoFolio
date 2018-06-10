$(document).ready(function(){
	var ctx =$("#bar-chartcanvas");
	var data={
		lables:{"MATCH1","MATCH2","MATCH3","MATCH4","MATCH5",};
		DATASET:[
			{
				lables:"teamA score",
				data:[10,50,25,70,40],
				backgroundColor:[
					"rgba(10,20,30,0.3)",
					"rgba(10,20,30,0.3)",
					"rgba(10,20,30,0.3)",
					"rgba(10,20,30,0.3)",
					"rgba(10,20,30,0.3)",
				],
				borderColor:[
				"rgba(10,20,30,1)",
				"rgba(10,20,30,1)",
				"rgba(10,20,30,1)",
				"rgba(10,20,30,1)",
				"rgba(10,20,30,1)",
				],
				borderWidth:1;
			},
			{
				lables:"teamB score",
				data:[20,35,40,70,40],
				backgroundColor:[
					"rgba(10,20,30,0.3)",
					"rgba(10,20,30,0.3)",
					"rgba(10,20,30,0.3)",
					"rgba(10,20,30,0.3)",
					"rgba(10,20,30,0.3)",
				],
				borderColor:[
				"rgba(10,20,30,1)",
				"rgba(10,20,30,1)",
				"rgba(10,20,30,1)",
				"rgba(10,20,30,1)",
				"rgba(10,20,30,1)",
				],
				borderWidth:1;
			}
		]
	};
	var chart=new Chart(ctx,{
		type:"bar",
		data:{},
		options:{}
	});
});
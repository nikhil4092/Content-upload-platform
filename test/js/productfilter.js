$(document).ready(function() {
    function showValues() {
		$("#productContainer").css("opacity",0.5);
		$("#loaderID").css("opacity",1);
		//e.css('visibility','visible');
		var mainarray = new Array();
		var brandarray = new Array();		
		var subarray = new Array();
		var terarray = new Array();
		$('input[name="subcheck"]:checked').each(function(){
			//	
			subarray.push($(this).val().replace("&","and"));	
			//alert($(this).val());		
			$('.spansubcatcls').css('visibility','visible');			
			//alert($(this).attr("checkboxname"));	
		});
		if(subarray=='') $('.spansubcatcls').css('visibility','hidden');
		var sub_checklist = "&subcheck="+subarray;
		$('input[name="tercheck"]:checked').each(function(){
			//		
			terarray.push($(this).val().replace("&","and"));	
			//alert($(this).val());		
			$('.spantercatcls').css('visibility','visible');			
			//alert($(this).attr("checkboxname"));	
		});
		if(terarray=='') $('.spantercatcls').css('visibility','hidden');
		var ter_checklist = "&tercheck="+terarray;


		$('input[name="bcheck"]:checked').each(function(){
			//		
			brandarray.push($(this).val());	
			//alert($(this).val());		
			$('.spanbrandcls').css('visibility','visible');			
			//alert($(this).attr("checkboxname"));	
		});
		if(brandarray=='') $('.spanbrandcls').css('visibility','hidden');
		var brand_checklist = "&bcheck="+brandarray;

		var brandsnewarray = new Array();	
		$('input[name="brcheck"]:checked').each(function(){
			//		
			brandsnewarray.push($(this).val());	
			//alert($(this).val());		
			$('.spanbrandsnewcls').css('visibility','visible');			
			//alert($(this).attr("checkboxname"));	
		});
		if(brandsnewarray=='') $('.spanbrandsnewcls').css('visibility','hidden');
		var brandsnew_checklist = "&brcheck="+brandsnewarray;

		var genderarray = new Array();		
		$('input[name="gcheck"]:checked').each(function(){
			//		
			genderarray.push($(this).val());	
			//alert($(this).val());		
			$('.spangendercls').css('visibility','visible');			
			//alert($(this).attr("checkboxname"));	
		});
		if(genderarray=='') $('.spangendercls').css('visibility','hidden');
		var gender_checklist = "&gcheck="+genderarray;
				
		var sizearray = new Array();		
		$('input[name="scheck"]:checked').each(function(){
			//alert($(this).val());			
			sizearray.push($(this).val());	
			$('.spansizecls').css('visibility','visible');	
		});
		if(sizearray=='') $('.spansizecls').css('visibility','hidden');
		var size_checklist = "&scheck="+sizearray;
		
		
		var colorarray = new Array();		
		$('input[name="ccheck"]:checked').each(function(){			
			colorarray.push($(this).val());
			$('.spancolorcls').css('visibility','visible');		
		});
		if(colorarray=='') $('.spancolorcls').css('visibility','hidden');
		var color_checklist = "&ccheck="+colorarray;

		var metaarray = new Array();		
		$('input[name="mcheck"]:checked').each(function(){			
			metaarray.push($(this).val());
			$('.spanmetacls').css('visibility','visible');		
		});
		if(metaarray=='') $('.spanmetacls').css('visibility','hidden');
		var meta_checklist = "&mcheck="+metaarray;

		
		/*var pricearray = new Array();		
		$('input[name="price_range"]:checked').each(function(){			
			pricearray.push($(this).val());
			$('.spanpricecls').css('visibility','visible');		
		});
		if(pricearray=='') $('.spanpricecls').css('visibility','hidden');
		var price_checklist = "&price_range="+pricearray;*/
		//alert(price_checklist);
		var main_string = brand_checklist+size_checklist+color_checklist+price_checklist+gender_checklist+brandsnew_checklist+meta_checklist+sub_checklist+ter_checklist;
		main_string = main_string.substring(1, main_string.length)
		//alert(main_string);
		
		
		$.ajax({
			type: "POST",
			url: "filter_products.php",
			data: main_string, 
			cache: false,
			success: function(html){
				//alert(html);
				$("#productContainer").html(html);		
				$("#productContainer").css("opacity",1);
				$("#loaderID").css("opacity",0);
				
				
				
			}
			});
		
		
	}
	var pricearray = "";
	var price_checklist = "";
	$('#select_all').click(function(event) {
	    if(this.checked) {
		// Iterate each checkbox
		$(':checkbox.content').each(function() {
		    this.checked = true;                        
		});
	    }
	    else{
		$(':checkbox.content').each(function() {
		    this.checked = false;                        
		});
		}	
	});
	$("input.sliderValue").on("change",function(){
		pricearray=$("input[name='min']").val().substring(3)+"-"+$("input[name='max']").val().substring(3);
		if(pricearray=='') $('.spanpricecls').css('visibility','hidden');
		price_checklist = "&price_range="+pricearray;
		showValues();
		$('.spanpricecls').css('visibility','hidden');
	});
	$("input[type='checkbox'][name!='select_all'], input[type='radio']").on( "click", showValues );
    $("select").on( "change", showValues );
	$('#content').off('click');
	
	$(".spanbrandcls").click(function(){
		$('.bcheck').removeAttr('checked');				
		showValues();
		$('.spanbrandcls').css('visibility','hidden');
	});
	$(".spanbrandsnewcls").click(function(){
		$('.brcheck').removeAttr('checked');				
		showValues();
		$('.spanbrandsnewcls').css('visibility','hidden');
	});
	$(".spansizecls").click(function(){
		$('.scheck').removeAttr('checked'); 
		showValues();
		$('.spansizecls').css('visibility','hidden');
	});
	$(".spanmetacls").click(function(){
		$('.mcheck').removeAttr('checked'); 
		showValues();
		$('.spanmetacls').css('visibility','hidden');
	});
	$(".spancolorcls").click(function(){
		$('.ccheck').removeAttr('checked'); showValues();
		$('.spancolorcls').css('visibility','hidden');
	});
	$(".spangendercls").click(function(){
		$('.gcheck').removeAttr('checked'); showValues();
		$('.spangendercls').css('visibility','hidden');
	});

	$(".spansubcatcls").click(function(){
		$('.gcheck').removeAttr('checked'); showValues();
		$('.spansubcatcls').css('visibility','hidden');
	});
	$(".spantercatcls").click(function(){
		$('.gcheck').removeAttr('checked'); showValues();
		$('.spantercatcls').css('visibility','hidden');
	});


	$('#slider').slider({
	    change: function(event, ui) {
		if (event.originalEvent) {
			pricearray=ui.values[0]+"-"+ui.values[1];
		}
		if(pricearray=='') $('.spanpricecls').css('visibility','hidden');
		price_checklist = "&price_range="+pricearray;
		showValues();
		$('.spanpricecls').css('visibility','hidden');
		    }
	});
	//$(".spanpricecls").click(showValues());
	/*$(".spanpricecls").click(function(){
		$('#slider').removeAttr('change'); showValues();
		$('.spanpricecls').css('visibility','hidden');
	});*/
	$(".clear_filters").click(function(){
		$('#productCategoryLeftPanel').find('input[type=checkbox]:checked').removeAttr('checked');
		$('#productCategoryLeftPanel').find('input[type=radio]:checked').removeAttr('checked');
		showValues();
	});
	
});	

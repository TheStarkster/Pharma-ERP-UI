var productList = [{"label":"Seclo-(Tabulate )","value":"55389399"},{"label":"Napaw-(0)","value":"21241237987341188895"},{"label":"Nicon 500-(Tabulate )","value":"71589185296781636784"},{"label":"Abon 42-(0)","value":"19124597431997594542"},{"label":"Netin 60-(0)","value":"19338495127441137796"},{"label":"Adex 20-(0)","value":"96763256326468348122"},{"label":"Opeal 50-(0)","value":"93735568217673448987"},{"label":"Zolfinal-(0)","value":"13849321685356861567"},{"label":"Mucomist-(0)","value":"66688588245272996258"},{"label":"Mucomist DT-(0)","value":"66665414712498731454"},{"label":"Mucomist-(0)","value":"79884394734717378932"},{"label":"Ultravir-(0)","value":"24839527999691743717"},{"label":"Epidual Gel-(0)","value":"86637462173573616868"},{"label":"Antivenom Injection-(0)","value":"87719247393126958534"},{"label":"Recolet    20-(0)","value":"86716352875194358486"},{"label":"Water For Injection-(0)","value":"64349779414581144154"},{"label":"Adrizolr 600 mg-(0)","value":"41512687472239669741"},{"label":"Advomicas-(0)","value":"74693473137167525864"},{"label":"Adprolimt Plus-(0)","value":"42476217522444636566"},{"label":"Apetonicg-(0)","value":"42331388613771552457"},{"label":"Adcipcinr-(0)","value":"34145329817335862547"},{"label":"Adcipcine-(0)","value":"38187743858179359913"},{"label":"Marlboro meko pakovanje-(Tabulate )","value":"860065412"}] ; 

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    function invoice_productList(cName) {
       
		var priceClass = 'price_item'+cName;
	
		var unit = 'unit_'+cName;
		var tax = 'total_tax_'+cName;
		var discount_type = 'discount_type_'+cName; 
		var batch_id = 'batch_id_'+cName;

        $( ".productSelection" ).autocomplete(
		{
            source: productList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				
				var id=ui.item.value;
				var dataString = 'product_id='+ id;
				var base_url = $('.baseUrl').val();

				$.ajax
				   ({
						type: "POST",
						url: base_url+"Cinvoice/retrieve_product_data_inv",
						data: dataString,
						cache: false,
						success: function(data)
						{
							var obj = jQuery.parseJSON(data);
								for (var i = 0; i < (obj.txnmber); i++) {
							var txam = obj.taxdta[i];
							var txclass = 'total_tax'+i+'_'+cName;
                           $('.'+txclass).val(txam);
							}

                         $('.'+priceClass).val(obj.price);
							$('.'+unit).val(obj.unit);
							$('.'+tax).val(obj.tax);
							$('#txfieldnum').val(obj.txnmber);
							$('#'+discount_type).val(obj.discount_type);
                            $('#'+batch_id).html(obj.batch);
							
							//This Function Stay on others.js page
							quantity_calculate(cName);
							
						} 
					});
				
				$(this).unbind("change");
				return false;
			}
		});
		$( ".productSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    }



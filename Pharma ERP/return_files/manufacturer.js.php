var manufacturerList = [{"label":"square ","value":"1"},{"label":"Farto & Deto Pharmaceuticals Ltd","value":"2"},{"label":"Bexilo","value":"3"},{"label":"ACL","value":"4"},{"label":"MPL Pharma","value":"5"},{"label":"GCL Pharmaceuticals Ltd","value":"6"},{"label":"Advlent ","value":"8"}] ; 

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    $(function() {
      
        $( ".manufacturerSelection" ).autocomplete(
		{
            source:manufacturerList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".manufacturer_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".manufacturer_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				$(this).unbind("change");
				return false;
			}
		});
			$( ".manufacturerSelection" ).focus(function(){
				$(this).change(APchange);
			
			});
    });

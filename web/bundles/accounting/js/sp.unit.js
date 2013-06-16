var unitSourceObj = new kendo.data.DataSource({
    transport: {
        create: {
            url: newUrlObj.createUnit,
            dataType: "json",
            type: "PUT"
        },
        parameterMap: function(options, operation) {
            if (operation == "create") {
                return {
                    models: kendo.stringify(options.models)
                };
            }
        }
    },
    batch: true,
    schema: {
        model: {
            id: "id",
            fields: {
                name: {type: "string"}
            }
        },
        parse:function (data) {
            $("#unitNew").data("kendoWindow").close();
            newColumnsObj.loadDropdowns(function(){
                newColumnsObj.unitsDropdown.data('kendoDropDownList').setDataSource(newColumnsObj.units);
                newColumnsObj.unitsDropdown.data('kendoDropDownList').refresh();
            });
            return data;
        }
    }
});

$(document).ready(function() {

    kendo.bind($("#unitForm"), kendo.observable({
        name: "",
        unitSource: unitSourceObj,
        save: function() {
            console.log('update');
            this.unitSource.add({
                name:this.name
            });
            this.unitSource.sync();
            console.log('success sync');
        },
        cancel: function(e) {
            e.preventDefault();
            $("#unitNew").data("kendoWindow").close();
        }
    }));

    $("#unitNew").kendoWindow({
        visible: false,
        modal: true,
        width: 300,
        title: "Create unit",
        actions: ["Close"]
    });

});

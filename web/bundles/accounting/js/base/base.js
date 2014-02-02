
/**
 * BaseTransport
 */
var BaseTransport = {
    parameterMap: function(options, operation) {
        if (operation == "create") {
            return {
                models: kendo.stringify(options.models)
            };
        }
    }
};

/**
 * BaseSchema
 */
var BaseSchema = {
    window : null,
    parse:function (data) {
        this.window.data("kendoWindow").close();
        FormBind.options.onClose(data);
        return data;
    }
};

/**
 * FormModelTransport
 */
var FormModelTransport = $.extend({
    create: {
        url: "",//reasign
        dataType: "json",
        type: "PUT"
    }
}, BaseTransport);

/**
 * FormModelSchema
 */
var FormModelSchema = $.extend({
    window : null,//reasign
    model: {
        id: "id",
        fields: null//reasign
    }
}, BaseSchema);

/**
 * FormActions
 */
var FormActions = {
    save: function(e) {
        e.preventDefault();
        FormModelTransport.create.url = FormBind.options.url.create;
        FormModelSchema.window = FormBind.options.window;
        FormModelSchema.model.fields = FormBind.options.fields.model;
        
        
        var FormModelStore = new kendo.data.DataSource({
            batch: true,
            transport: FormModelTransport,
            schema: FormModelSchema
        });
        
        var object = {};
        for(var index in FormBind.options.fields.model) { 
            object[index] = this[index];
        }
        FormModelStore.add(object);

        FormModelStore.sync();
    },
    cancel: function(e) {
        e.preventDefault();
        FormBind.options.window.data("kendoWindow").close();
    }
};

/**
 * FormWindow
 */
var FormWindow = {
    visible: false,
    modal: true,
    title: "Create",
    actions: ["Close"]
};

/**
 * FormBind
 */
var FormBind = {
    options : null,
    init : function(formOptions) {
        FormBind.options = formOptions;
        
        FormActions = $.extend(FormActions, formOptions.fields.form);
        
        kendo.bind(formOptions.form, kendo.observable(FormActions));
        
        formOptions.window.show();
        FormWindow.title = formOptions.title;
        formOptions.window.kendoWindow(FormWindow);
    }
};
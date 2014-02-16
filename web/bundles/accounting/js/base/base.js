
/**
 * FormModelTransport
 */
var FormModelTransport = {
    create: {
        url: "",//reasign
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
};

/**
 * FormModelSchema
 */
var FormModelSchema = {
    window : null,//reasign
    model: {
        id: "id",
        fields: null//reasign
    },
    afterClose : null,//reasign
    parse:function (data) {
        this.window.data("kendoWindow").close();
        if($.isFunction(this.afterClose)) {
            this.afterClose(data);
        }
        return data;
    }
};

/**
 * FormActions
 */
var FormActions = {
    formRef: "default",
    save: function(e) {
        e.preventDefault();
        var options = FormBind.options[this.formRef];
        
        FormModelTransport.create.url = options.url.create;
        FormModelSchema.window = options.window;
        FormModelSchema.model.fields = options.fields.model;
        FormModelSchema.afterClose = options.afterClose;
        
        
        var formModelStore = new kendo.data.DataSource({
            batch: true,
            transport: FormModelTransport,
            schema: FormModelSchema
        });
        
        var object = {};
        for(var index in options.fields.model) { 
            object[index] = this[index];
        }
        formModelStore.add(object);

        formModelStore.sync();
    },
    cancel: function(e) {
        e.preventDefault();
        FormBind.options[this.formRef].window.data("kendoWindow").close();
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
    options : [],
    init : function(formOptions) {
        
        var form = $.extend({}, FormActions, formOptions.fields.form);
        form.formRef = formOptions.formRef;
        
        FormBind.options[form.formRef] = formOptions;
        
        kendo.bind(formOptions.form, kendo.observable(form));
        
        formOptions.window.show();
        FormWindow.title = formOptions.title;
        formOptions.window.kendoWindow(FormWindow);
    }
};
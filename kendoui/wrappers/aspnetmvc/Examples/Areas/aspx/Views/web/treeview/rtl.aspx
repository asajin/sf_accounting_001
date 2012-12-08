<%@ Page Title="" Language="C#" MasterPageFile="~/Areas/aspx/Views/Shared/Web.Master" Inherits="System.Web.Mvc.ViewPage<dynamic>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="HeadContent" runat="server">
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">

<div class="k-rtl">

<div class="treeview-back">
    <h3>TreeView with images</h3>
    <%= Html.Kendo().TreeView()
        .Name("treeview-images")
        .Items(treeview =>
        {
            treeview.Add().Text("Inbox")
                .ImageUrl(Url.Content("~/Content/web/treeview/mail.png"))
                .Expanded(true)
                .Items(inbox =>
                {
                    inbox.Add().Text("Read Mail")
                        .ImageUrl(Url.Content("~/Content/web/treeview/readmail.png"));
                });

            treeview.Add().Text("Drafts")
                .ImageUrl(Url.Content("~/Content/web/treeview/edit.png"));

            treeview.Add().Text("Search Folders")
                .ImageUrl(Url.Content("~/Content/web/treeview/search.png"))
                .Expanded(true)
                .Items(inbox =>
                {
                    inbox.Add().Text("Categorized Mail")
                        .ImageUrl(Url.Content("~/Content/web/treeview/search.png"));

                    inbox.Add().Text("Large Mail")
                        .ImageUrl(Url.Content("~/Content/web/treeview/search.png"));

                    inbox.Add().Text("Unread Mail")
                        .ImageUrl(Url.Content("~/Content/web/treeview/search.png"));
                });

            treeview.Add().Text("Settings")
                .ImageUrl(Url.Content("~/Content/web/treeview/settings.png"));
        })
    %>
</div>

<div class="treeview-back">
    <h3>TreeView with sprites</h3>
    <%= Html.Kendo().TreeView()
        .Name("treeview-sprites")
        .Items(treeview =>
        {
            treeview.Add().Text("My Documents")
                .SpriteCssClasses("rootfolder")
                .Expanded(true)
                .Items(root =>
                {
                    root.Add().Text("Kendo UI Project")
                        .Expanded(true)
                        .SpriteCssClasses("folder")
                        .Items(project =>
                        {
                            project.Add().Text("about.html").SpriteCssClasses("html");
                            project.Add().Text("index.html").SpriteCssClasses("html");
                            project.Add().Text("logo.png").SpriteCssClasses("image");
                        });

                    root.Add().Text("New Web Site")
                        .Expanded(true)
                        .SpriteCssClasses("folder")
                        .Items(item =>
                        {
                            item.Add().Text("mockup.jpg").SpriteCssClasses("image");
                            item.Add().Text("Research.pdf").SpriteCssClasses("pdf");
                        });

                    root.Add().Text("Reports")
                        .Expanded(true)
                        .SpriteCssClasses("folder")
                        .Items(reports =>
                        {
                            reports.Add().Text("February.pdf").SpriteCssClasses("pdf");
                            reports.Add().Text("March.pdf").SpriteCssClasses("pdf");
                            reports.Add().Text("April.pdf").SpriteCssClasses("pdf");
                        });
                });
        })
    %>
</div>

</div>

<style scoped>
    #treeview-sprites .k-sprite {
        background-image: url("<%= Url.Content("~/Content/web/treeview/coloricons-sprite.png")%>");
    }
    
    .rootfolder { background-position: 0 0; }
    .folder { background-position: 0 -16px; }
    .pdf { background-position: 0 -32px; }
    .html { background-position: 0 -48px; }
    .image { background-position: 0 -64px; }
    
    .treeview-back 
    {
        float: right;
        width: 200px;
        margin: 30px;
        padding: 20px;
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.45), inset 0 0 30px rgba(0,0,0,0.07);
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.45), inset 0 0 30px rgba(0,0,0,0.07);
        box-shadow: 0 1px 2px rgba(0,0,0,0.45), inner 0 0 30px rgba(0,0,0,0.07);
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
    }
    
    .treeview-back h3
    {
        margin: 0 0 10px 0;
        padding: 0;
    }
</style>
</asp:Content>
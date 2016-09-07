var myApp = angular.module('myApp', ['ng-admin']);
myApp.config(['NgAdminConfigurationProvider', function (nga) {
    // create an admin application
    var admin = nga.application('My First Admin')
      .baseApiUrl(baseApiUrl); // main API endpoint
    // create a user entity
    var user = nga.entity('users');
    
    var adminroles = [
        { label: '管理员', value: 'admin' },
        { label: '运营专员', value: 'manager' },
    ];
    var status = [
        { label: '未审核', value: 0 },
        { label: '已审核', value: 1 },
    ];
    // set the fields of the user entity list view
    user.listView()
            .title('管理员列表')
            .fields([
                nga.field('id').label('id'),
                nga.field('username'),
                nga.field('email'),
                nga.field('created_at', 'date'),
                nga.field('updated_at', 'date')
            ])
            .listActions(['show', 'edit', 'delete']);
    
    user.creationView()
            .title('创建管理员')
            .fields([
                nga.field('username').validation({ required: true, minlength: 3, maxlength: 100 }),
                nga.field('email').validation({ required: true, minlength: 3, maxlength: 100 }),
                nga.field('password').validation({ minlength: 3, maxlength: 100 }),
                nga.field('role','choice').choices(adminroles).label('角色'),
                nga.field('status','choice').choices(status).label('状态')
            ]);
    user.editionView()
            .title('编辑管理员 "{{ entry.values.username }}"') 
            .actions(['list', 'show', 'delete'])
            .fields([
                user.creationView().fields()
            ]);
            
    user.showView()
            .fields([
                nga.field('username'),
                nga.field('email'),
                nga.field('password'),
                nga.field('role','choice').choices(adminroles),
                nga.field('status','choice').choices(status)
            ]);
    
    
    // add the user entity to the admin application
    admin.addEntity(user)
    
     // customize header
    var customHeaderTemplate =
            
            '<div class="navbar-header">'+
                '<button type="button" class="navbar-toggle" ng-click="isCollapsed = !isCollapsed">'+
                    '<span class="icon-bar"></span>'+
                    '<span class="icon-bar"></span>'+
                    '<span class="icon-bar"></span>'+
                '</button>'+
                '<a class="navbar-brand" href="#" ng-click="appController.displayHome()">Posters Galore Backend</a>'+
            '</div>'+
            '<ul class="nav navbar-top-links navbar-right hidden-xs">'+
//                '<li>'+
//                    '<a href="https://github.com/marmelab/ng-admin-demo">'+
//                        '<i class="fa fa-github fa-lg"></i>&nbsp;Source'+
//                    '</a>'+
//                '</li>'+
                '<li uib-dropdown>'+
                    '<a uib-dropdown-toggle href="#" aria-expanded="true">'+
                        '<i class="fa fa-user fa-lg"></i>&nbsp;'+username+'&nbsp;<i class="fa fa-caret-down"></i>'+
                    '</a>'+
                    '<ul class="dropdown-menu dropdown-user" role="menu">'+
                        '<li><a href="'+baseUrl+'logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>'+
                    '</ul>'+
                '</li>'+
            '</ul>'
    ;
    admin.header(customHeaderTemplate);

    // customize menu
    admin.menu(nga.menu()
        .addChild(nga.menu(user).title('管理员').icon('<span class="glyphicon glyphicon-file"></span>')) // customize the entity menu icon
//        .addChild(nga.menu(comment).icon('<strong style="font-size:1.3em;line-height:1em">✉</strong>')) // you can even use utf-8 symbols!
//        .addChild(nga.menu(tag).icon('<span class="glyphicon glyphicon-tags"></span>'))
        .addChild(nga.menu().title('活动列表')
            .addChild(nga.menu().title('定制页面').icon('').link('/link'))
        )
    );

    // attach the admin application to the DOM and execute it
    nga.configure(admin);
    
    
    
}]);

// custom page with menu item
    var customPageTemplate = '<div class="row"><div class="col-lg-12">' +
            '<ma-view-actions><ma-back-button></ma-back-button></ma-view-actions>' +
            '<div class="page-header">' +
                '<h1>Stats</h1>' +
                '<p class="lead">You can add custom pages, too</p>' +
            '</div>' +
        '</div></div>';
    myApp.config(['$stateProvider', function ($stateProvider) {
        $stateProvider.state('stats', {
            parent: 'main',
            url: '/stats',
            template: customPageTemplate
        });
    }]);
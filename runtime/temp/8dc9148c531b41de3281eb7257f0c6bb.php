<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"/opt/web/hqy/public/../application/v1/view/system/addmenu.html";i:1566974800;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/static/assets/components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/assets/components/bootstrap-select/css/bootstrap-select.css">
    <link rel="stylesheet" type="text/css" href="/static/assets/plugins/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/static/assets/dist/css/admin.css">
    <script src="/static/assets/components/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="/static/assets/plugins/laydate-v5.0/laydate.js"></script>
    <script src="/static/assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/static/assets/components/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="/static/assets/plugins/layer/layer.js"></script>
    <script src="/static/assets/dist/js/style.js"></script>
    <title>添加菜单</title>
</head>
<body>
<div class="dialog-content">
    <form class="form-horizontal" id="form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">标题：</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" value="" >
                    </div>
                </div>
                <div class="form-group">
                    <lebel class="col-sm-3 control-label">父类：</lebel>
                    <div class="col-sm-9">
                        <select class="form-control selectpicker show-tick" >
                            <option value="0">无</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">菜单类型：</label>
                    <div class="col-sm-9">
                        <select class="form-control selectpicker show-tick" id="type" name="type">
                            <option value="0">普通菜单</option>
                            <option value="1">特殊菜单</option>
                            <option value="2">节点</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">状态：</label>
                    <div class="radio">
                        &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <input type="radio"  id="status0" name="status" value="0"> 禁用
                        &nbsp; &nbsp;&nbsp; &nbsp;
                        <input type="radio"  id="status1" name="status" value="1"> 正常
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">请求地址：</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="url" name="url" value="" placeholder="链接地址">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">图标：</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="icon" name="icon" value="" placeholder="图标">
                        <a href="javascript:;" class="btn btn-default btn-search-icon" onclick="admin_module.show_icon()">Search icon</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">备注：</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="remark" name="remark" placeholder="说点什么···"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="dialog-footer">
            <button class="btn btn-primary" id="pass_btn" type="button" data="" onclick="admin_module.save_menu(this);"  data-url="<?php echo url('v1/system/savemenu'); ?>"><i class="glyphicon glyphicon-ok"></i>确认</button>
            <button class="btn btn-danger" id="no_pass_btn" onclick="admin_module.cancel_btn()"  data="" data-url=""> <i class="glyphicon glyphicon-remove"></i>取消</button>
        </div>
    </form>
</div>
<script type="text/javascript">

    $(window).on('load', function () {
        $('#selectpicker').selectpicker('refresh');
        $('#selectpicker').selectpicker('render');
        $('#selectpicker').selectpicker({
            'selectedText': 'cat'
        });

    });

</script>
</body>
</html>
define(['jQuery'],function($) {

    // ---------------------------------------------------
    // 日期格式化
    // 格式 YYYY/yyyy/YY/yy 表示年份
    // MM/M 月份
    // W/w 星期
    // dd/DD/d/D 日期
    // hh/HH/h/H 时间
    // mm/m 分钟
    // ss/SS/s/S 秒
    // ---------------------------------------------------
    Date.prototype.Format = function(formatStr) {
        var str = formatStr;
        var Week = [ '日', '一', '二', '三', '四', '五', '六' ];

        str = str.replace(/yyyy|YYYY/, this.getFullYear());
        str = str.replace(/yy|YY/,
                (this.getYear() % 100) > 9 ? (this.getYear() % 100).toString()
                        : '0' + (this.getYear() % 100));

        str = str.replace(/MM/, this.getMonth() > 9 ? this.getMonth()
                .toString() : '0' + this.getMonth());
        str = str.replace(/M/g, this.getMonth());

        str = str.replace(/w|W/g, Week[this.getDay()]);

        str = str.replace(/dd|DD/, this.getDate() > 9 ? this.getDate()
                .toString() : '0' + this.getDate());
        str = str.replace(/d|D/g, this.getDate());

        str = str.replace(/hh|HH/, this.getHours() > 9 ? this.getHours()
                .toString() : '0' + this.getHours());
        str = str.replace(/h|H/g, this.getHours());
        str = str.replace(/mm/, this.getMinutes() > 9 ? this.getMinutes()
                .toString() : '0' + this.getMinutes());
        str = str.replace(/m/g, this.getMinutes());

        str = str.replace(/ss|SS/, this.getSeconds() > 9 ? this.getSeconds()
                .toString() : '0' + this.getSeconds());
        str = str.replace(/s|S/g, this.getSeconds());
        str = str.replace(/u|U/g, (this.getMilliseconds() / 1000 + "00000")
                .substring(2, 5));
        return str;
    }
    return {
        /**
         * @param cfg Object
         *  {
         *      "url" : "/attr/{id}",
         *      "method" : "PUT",
         *      "params" : [
         *          "id"
         *      ]
         *  }
         */
        parseUriPattern : function(cfg,params){
            var url = cfg.url;
            for(var i in cfg.param){
                url = url.replace('{' + cfg.param[i] + '}',params[cfg.param[i]]);
            }
            return {
                'url' : url,
                'method' : cfg.method
            };
        },
        isEmptyObj : function(obj){
            for(var i in obj){
                return false;
            }
            return true;
        },
        ajax : $.ajax,
        apiReqSuccess : function(ret){
            return ret.code === 1;
        },
        apiReqMsg : function(ret){
            return ret.msg;
        },
        apiReqData : function(ret){
            return ret.data;
        },
        now : function() {
            // return (new Date()).Format('yyyy-MM-dd HH:mm:ss');
            return (new Date()).Format('HH:mm:ss.u');
        },
        extendOptions : function(defaultOptions, options) {
            for ( var i in options) {
                if (typeof options[i] == 'function') {
                    defaultOptions[i] = options[i];
                    continue;
                }
                if (options[i] instanceof Object) {
                    for ( var j in options[i]) {
                        if (typeof options[i][j] == 'function') {
                            defaultOptions[i][j] = options[i][j];
                            continue;
                        }
                        if (options[i][j] instanceof Object) {
                            for ( var k in options[i][j]) {
                                defaultOptions[i] = defaultOptions[i] ? defaultOptions[i]
                                        : {};
                                defaultOptions[i][j] = defaultOptions[i][j] ? defaultOptions[i][j]
                                        : {};
                                defaultOptions[i][j][k] = options[i][j][k];
                            }
                        } else {
                            defaultOptions[i] = defaultOptions[i] ? defaultOptions[i]
                                    : {};
                            defaultOptions[i][j] = options[i][j];
                        }
                    }
                } else {
                    defaultOptions[i] = options[i];
                }
            }
            return defaultOptions;
        },
        getSequence : function() {
            var rnd = '' + Math.floor(Math.random() * 1000);
            while (rnd.length < 3)
                rnd = '0' + rnd;
            var st = this.timestamp() + '';
            // console.log(st);
            return st.substring(0, 3) + st.substring(6) + rnd;
        },
        timestamp : function() {
            return parseInt((new Date()).valueOf() / 1000);
        },
        getOptionOrDefault : function(options, key, defaultValue) {
            if (!options) {
                return defaultValue;
            }
            return options[key] === undefined ? defaultValue : options[key];
        },
        array_reverse : function(data) {
            var map = [];
            for ( var key in data) {
                map[data[key]] = key;
            }
            return map
        },
        _ajax : function(options) {
            options = options || {};
            options.type = (options.type || "GET").toUpperCase();
            options.dataType = options.dataType || "json";
            options.async = options.async === undefined ? true : options.async;
            var params = this.formatParams(options.data);
            // 创建 - 非IE6 - 第一步
            if (window.XMLHttpRequest) {
                var xhr = new XMLHttpRequest();
            } else { // IE6及其以下版本浏览器
                var xhr = new ActiveXObject('Microsoft.XMLHTTP');
            }
            // 接收 - 第三步
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    var status = xhr.status;
                    if (status >= 200 && status < 300) {
                        if ('json' == options.dataType) {
                            // validate json
                            var jsonObj = false;
                            try {
                                var jsonObj = JSON.parse(xhr.responseText);
                            } catch (e) {
                                jsonObj = false;
                            }
                            if (false === jsonObj) {
                                options.success
                                        && options.success(xhr.responseText,
                                                xhr.responseXML);
                            } else {
                                options.success
                                        && options.success(jsonObj, xhr);
                            }
                        } else {
                            options.success
                                    && options.success(xhr.responseText,
                                            xhr.responseXML);
                        }
                    } else {
                        options.fail && options.fail(status);
                    }
                }
            }
            // 连接 和 发送 - 第二步
            if (options.type == "GET") {
                xhr.open("GET", options.url + "?" + params, options.async);
                xhr.send(null);
            } else if (options.type == "POST") {
                xhr.open("POST", options.url, options.async);
                // 设置表单提交时的内容类型
                xhr.setRequestHeader("Content-Type",
                        "application/x-www-form-urlencoded");
                xhr.send(params);
            }
        },
        // 格式化参数
        formatParams : function(data) {
            var arr = [];
            for ( var name in data) {
                arr.push(encodeURIComponent(name) + "="
                        + encodeURIComponent(data[name]));
            }
            arr.push(("v=" + Math.random()).replace(".", ""));
            return arr.join("&");
        },
        validateCallback : function(func) {
            return (undefined !== func && typeof func == 'function');
        },
        isFunction : function(obj) {
            return Object.prototype.toString.call(obj) === '[object Function]'
        },
        fireFunction : function(func, params) {
            if (func && this.isFunction(func)) {
                return func.apply('', params);
            }
            return false;
        },
        array_get : function(array, key, defaultValue) {
            var config = array, keys;
            if (typeof key == 'object' && key instanceof Array) {
                keys = key;
            } else {
                if (key.indexOf('.') != -1) {
                    keys = key.split('.');
                } else {
                    keys = [ key ];
                }
            }
            for ( var i in keys) {
                if (undefined == config[keys[i]]) {
                    return defaultValue;
                } else {
                    config = config[keys[i]];
                }
            }
            return config;
        }
    };
});

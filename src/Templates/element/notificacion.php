<div class="notification">
    <span class="icon">
        <i class=""></i>
    </span>
    <span class="text"></span>
    <span class="close"><i class="fa fa-close"></i></span>
</div>
<style>
    .notification {
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,.1);
        border-radius: 5px;
        display: flex;
        height: 60px;
        justify-content: space-between;
        opacity: 0;
        padding-right: 15px;
        position: fixed;
        right: 30px;
        top: 150px;
        visibility: hidden;
        transition: all .5s ease;
        width: 270px;
        z-index: 100;
    }
    .notification.visible {
        opacity: 1;
        top: 20px;
        visibility: visible;
    }
    .notification.info {
        background-color: #2980b9;
    }
    .notification.error {
        background-color: #e74c3c;
        width: 300px ;
    }
    .notification.warning {
        background-color: #f39c12;
    }
    .notification > .icon {
        align-items: center;
        display: flex;
        height: 100%;
        justify-content: center;
        width: 50px;
    }
    .notification > .icon > i {
        color: white;
        cursor: default;
    }
    .notification > .text {
        align-items: center;
        color: white;
        cursor: default;
        display: flex;
        font-weight: 400;
        font-size: 15px;
        width: calc(95% - 50px);
        word-wrap: normal;
    }
    .notification > .close {
        color: rgba(255, 255, 255, .8);
        cursor: pointer;
        position: absolute;
        right: 8px;
        top: 5px;
        transition: color .3s ease;
    }
    .notification > .close:hover {
        color: #fff;
    }

</style>
<script>
    function Notification(htmlElement) {
        this.htmlElement = htmlElement;
        this.icon = htmlElement.querySelector('.icon > i');
        this.text = htmlElement.querySelector('.text');
        this.close = htmlElement.querySelector('.close');
        this.isRunning = false;
        this.timeout;
        
        this.bindEvents();
    };

    Notification.prototype.bindEvents = function() {
        var self = this;
        this.close.addEventListener('click', function() {
            window.clearTimeout(self.timeout);
            self.reset();
        });
    }

    Notification.prototype.info = function(message) {
        if(this.isRunning) return false;
        
        this.text.innerHTML = message;
        this.htmlElement.className = 'notification info';
        this.icon.className = 'fa fa-2x fa-info-circle';
        
        this.show();
    }

    Notification.prototype.warning = function(message) {
        if(this.isRunning) return false;
        
        this.text.innerHTML = message;
        this.htmlElement.className = 'notification warning';
        this.icon.className = 'fa fa-2x fa-exclamation-triangle';
        
        this.show();
    }

    Notification.prototype.error = function(message) {
        if(this.isRunning) return false;
        
        this.text.innerHTML = message;
        this.htmlElement.className = 'notification error';
        this.icon.className = 'fa fa-2x fa-exclamation-circle';
        
        this.show();
    }

    Notification.prototype.show = function() {
        if(!this.htmlElement.classList.contains('visible'))
            this.htmlElement.classList.add('visible');
        
        this.isRunning = true;
        this.autoReset();
    };
        
    Notification.prototype.autoReset = function() {
        var self = this;
        this.timeout = window.setTimeout(function() {
            self.reset();
        }, 2000);
    }

    Notification.prototype.reset = function() {
        this.htmlElement.className = "notification";
        this.icon.className = "";
        this.isRunning = false;
    };
</script>


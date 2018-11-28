function Tab(){};
Tab.prototype.init = function(btn_selector,item_selector){
    this.abtn = document.querySelectorAll(btn_selector);
    this.aitem = document.querySelectorAll(item_selector);
    this.handleEvent();
}
Tab.prototype.handleEvent = function(){
    for(var i = 0 ; i < this.abtn.length ; i ++){
        this.abtn[i].index = i;
        this.abtn[i].onclick = this.changIndex.bind(this);
    }
}
Tab.prototype.changIndex = function(event){
    var e = event || window.event;
    var target = e.target || e.srcElement;
    this.nowIndex = target.index;
    this.show();
}
Tab.prototype.show = function(){
    for(var i = 0 ; i < this.aitem.length ; i ++){
        this.aitem[i].style.display = "none";
        this.abtn[i].className = "";
    }
    this.aitem[this.nowIndex].style.display = "block";
    this.abtn[this.nowIndex].className = "active";
}

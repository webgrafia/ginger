
function select_privacy_page(){

    document.getElementById('privacy_page_select').disabled=false;
    document.getElementById('new_page_privacy').style.display='none';
    document.getElementById('new_page_privacy').style.display='none';
}

function new_privacy_page(){

    document.getElementById('privacy_page_select').disabled=true;
    document.getElementById('new_page_privacy').style.display='inline';
    document.getElementById('new_page_privacy').style.display='inline';
}
function disable_text_banner_button(id){

    document.getElementById(id).disabled=true;
    document.getElementById('new_page_privacy').style.display='inline';
    document.getElementById('new_page_privacy').style.display='inline';
}
function enable_text_banner_button(id){

    document.getElementById(id).disabled=false;
    document.getElementById('new_page_privacy').style.display='inline';
    document.getElementById('new_page_privacy').style.display='inline';
}

function en_dis_able_text_banner_button(id,id_text,id_img){

    var status=document.getElementById(id).checked;


    if (status){

        document.getElementById(id_text).disabled=false;
        document.getElementById(id_img).src='../wp-content/plugins/ginger/img/ok.png';

    }else if (!status){

        document.getElementById(id_text).disabled=true;
        document.getElementById(id_img).src='../wp-content/plugins/ginger/img/xx.png';


    }

}

function en_dis_able_add_on(id,id_img,id_text){


    var status=document.getElementById(id).checked;


    if (status){
        if (id!='google_analytics_status') {
            document.getElementById(id_text).disabled = false;
        }
        document.getElementById(id_img).src='../wp-content/plugins/ginger/img/ok.png';

    }else if (!status){

        document.getElementById(id_text).disabled=true;
        document.getElementById(id_img).src='../wp-content/plugins/ginger/img/xx.png';
    }

}

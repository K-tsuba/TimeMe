function delete_time($id){
    if (window.confirm('本当に削除しますか？')){
        document.getElementById('form_'.$id).submit();
    } else {
        window.alert('削除がキャンセルされました。');
        event.preventDefault();
    }
}
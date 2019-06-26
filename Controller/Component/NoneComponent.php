<?php
class NoneComponent extends Component {
    /**
     * 暗号化しないでそのまま返す
     */
    function hashPasswords($data){
        return $data;
    }
}
?>

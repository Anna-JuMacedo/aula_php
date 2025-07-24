<?php

public function excluir() {
    $query = "DELETE FROM " . $this->nome_tabela . "WHERE id = :id";
    $stmt = $this->conexao->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':id', $this->id);

    return $stmt->execute();
}

?>
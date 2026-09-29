<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Versiculos Bíblicos</title>
    <link rel="stylesheet" href="css/main_styles.css">
</head>
<body>
    <h1>"Sua dose diária de inspiração e sabedoria na Palavra"</h1>
    <a href="index.php?acao=Detalhe"><strong>Novo Versículo</strong></a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Versículos</th>
                <th>Situação</th>
                <th>Alteração</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($versiculos as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td>
                    <strong><?= htmlspecialchars($v['versiculo']) ?></strong>
                    <p style="font-size: 0.9em; color: #555;"><?= nl2br(htmlspecialchars($v['conteudo'])) ?></p>
                </td>
                <td>
                    <?= $v['ativo'] == 1 ? '<span style="color:green;">Ativo</span>' : '<span style="color:red;">Inativo</span>' ?>
                </td>
                <td>
                    <a href="index.php?acao=editar&id=<?= $v['id'] ?>">Editar</a> | 
                    <?php if ($v['ativo'] == 1): ?>
                        <a href="index.php?acao=status&id=<?= $v['id'] ?>&status=0" onclick="return confirm('Deseja inativar?')">Inativar</a>
                    <?php else: ?>
                        <a href="index.php?acao=status&id=<?= $v['id'] ?>&status=1">Activar</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRM Cadastros</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 4px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
<h2 style="text-align:center">CRM CADASTRO DE USUARIOS</h2>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Data Cadastro</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($rec->name); ?></td>
            <td><?php echo e($rec->email); ?></td>
            <td><?php echo e($rec->phone); ?></td>
            <td><?php echo e(\Carbon\Carbon::parse($rec->created_at)->format('d/m/Y H:i')); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</body>
</html> <?php /**PATH D:\WindSurfProjects\raspadinha_29do7\resources\views\pdf\crm-signups.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>Mis Planes de Entrenamiento</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 3px solid #007bff; padding-bottom: 10px; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        tr:hover { background: #f1f1f1; }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; margin-right: 10px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-small { padding: 5px 10px; font-size: 14px; }
        .badge { padding: 5px 10px; border-radius: 15px; font-size: 12px; }
        .badge-active { background: #28a745; color: white; }
        .badge-inactive { background: #6c757d; color: white; }
        .actions { display: flex; gap: 10px; }
        .empty-state { text-align: center; padding: 40px; color: #666; }
        .empty-state i { font-size: 50px; color: #ccc; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mis Planes de Entrenamiento</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        <div style="margin-bottom: 20px;">
            <a href="{{ route('planes.create') }}" class="btn btn-success">Crear Nuevo Plan</a>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver al Dashboard</a>
        </div>
        
        @if($planes->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planes as $plan)
                    <tr>
                        <td>{{ $plan->id }}</td>
                        <td><strong>{{ $plan->nombre }}</strong></td>
                        <td>{{ $plan->descripcion ?? 'Sin descripción' }}</td>
                        <td>{{ date('d/m/Y', strtotime($plan->fecha_inicio)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($plan->fecha_fin)) }}</td>
                        <td>
                            @if($plan->activo)
                                <span class="badge badge-active">Activo</span>
                            @else
                                <span class="badge badge-inactive">Inactivo</span>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('planes.show', $plan->id) }}" class="btn btn-primary btn-small">Ver</a>
                            <a href="{{ route('planes.edit', $plan->id) }}" class="btn btn-warning btn-small">Editar</a>
                            <form action="{{ route('planes.destroy', $plan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-small" 
                                        onclick="return confirm('¿Estás seguro de eliminar este plan?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <p style="margin-top: 20px; color: #666;">
                <strong>Total:</strong> {{ $planes->count() }} planes
            </p>
        @else
            <div class="empty-state">
                <div style="font-size: 60px; color: #ddd; margin-bottom: 20px;">📭</div>
                <h3>No tienes planes de entrenamiento</h3>
                <p>Crea tu primer plan para comenzar a organizar tus entrenamientos</p>
                <a href="{{ route('planes.create') }}" class="btn btn-success" style="margin-top: 20px;">
                    ➕ Crear mi primer plan
                </a>
            </div>
        @endif
    </div>
</body>
</html>
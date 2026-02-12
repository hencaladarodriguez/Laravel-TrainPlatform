<!DOCTYPE html>
<html>
<head>
    <title>Plan: {{ $plan->nombre }}</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 3px solid #007bff; padding-bottom: 10px; }
        .plan-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .info-row { display: flex; margin-bottom: 10px; }
        .info-label { font-weight: bold; width: 150px; color: #555; }
        .info-value { flex: 1; }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; margin-right: 10px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .badge { padding: 5px 10px; border-radius: 15px; font-size: 14px; }
        .badge-active { background: #28a745; color: white; }
        .badge-inactive { background: #dc3545; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1> Detalles del Plan</h1>
        
        <div class="plan-info">
            <div class="info-row">
                <div class="info-label">Nombre:</div>
                <div class="info-value"><strong>{{ $plan->nombre }}</strong></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Descripción:</div>
                <div class="info-value">{{ $plan->descripcion ?? 'Sin descripción' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Objetivo:</div>
                <div class="info-value">{{ $plan->objetivo ?? 'Sin objetivo específico' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Fecha Inicio:</div>
                <div class="info-value">{{ date('d/m/Y', strtotime($plan->fecha_inicio)) }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Fecha Fin:</div>
                <div class="info-value">{{ date('d/m/Y', strtotime($plan->fecha_fin)) }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Duración:</div>
                <div class="info-value">
                    @php
                        $inicio = new DateTime($plan->fecha_inicio);
                        $fin = new DateTime($plan->fecha_fin);
                        $diferencia = $inicio->diff($fin);
                        echo $diferencia->days . ' días';
                    @endphp
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Estado:</div>
                <div class="info-value">
                    @if($plan->activo)
                        <span class="badge badge-active">Activo</span>
                    @else
                        <span class="badge badge-inactive">Inactivo</span>
                    @endif
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Creado por:</div>
                <div class="info-value">Ciclista ID: {{ $plan->id_ciclista }}</div>
            </div>
        </div>
        
        <div style="margin-top: 30px;">
            <a href="{{ route('planes.edit', $plan->id) }}" class="btn btn-primary">Editar Plan</a>
            <a href="{{ route('planes.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
        </div>
    </div>
</body>
</html>
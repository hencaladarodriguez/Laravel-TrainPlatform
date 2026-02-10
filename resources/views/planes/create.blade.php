<!DOCTYPE html>
<html>
<head>
    <title>Crear Nuevo Plan</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 3px solid #28a745; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        textarea { height: 100px; resize: vertical; }
        .btn { display: inline-block; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; border: none; cursor: pointer; }
        .btn-success { background: #28a745; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .error { color: #dc3545; font-size: 14px; margin-top: 5px; }
        .form-actions { margin-top: 30px; display: flex; gap: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crear Nuevo Plan de Entrenamiento</h1>
        
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('planes.store') }}">
            @csrf
            
            <div class="form-group">
                <label for="nombre">Nombre del Plan *</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required 
                       placeholder="Ej: Plan Maratón 80km">
                @error('nombre') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" 
                          placeholder="Describe tu plan de entrenamiento...">{{ old('descripcion') }}</textarea>
                @error('descripcion') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label for="objetivo">Objetivo</label>
                <input type="text" name="objetivo" id="objetivo" value="{{ old('objetivo') }}"
                       placeholder="Ej: Completar 80km en 3 horas">
                @error('objetivo') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio *</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin *</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}" required>
                @error('fecha_fin') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Guardar Plan</button>
                <a href="{{ route('planes.index') }}" class="btn btn-secondary">↩Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
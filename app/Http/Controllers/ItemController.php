<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * ItemController
 *
 * Implements the 3 endpoints used as a DevOps "deployment practice target".
 * Data is hardcoded on purpose — the focus of this course is shipping the
 * app (Docker, CI/CD, Kubernetes, AWS), not building the app itself.
 */
class ItemController extends Controller
{
    /**
     * GET /  — a short welcome that names the stack.
     */
    public function welcome(): JsonResponse
    {
        return response()->json([
            'app'     => 'DevOps Practice Target',
            'stack'   => 'PHP 8.2 + Laravel 11',
            'message' => 'Welcome! Dockerize and deploy me. Try /health and /api/items.',
        ]);
    }

    /**
     * GET /health  — liveness/readiness probe target.
     */
    public function health(): JsonResponse
    {
        return response()->json(['status' => 'ok']);
    }

    /**
     * GET /api/items  — a small fixed list to prove the app actually works.
     */
    public function items(): JsonResponse
    {
        return response()->json([
            ['id' => 1, 'name' => 'Containerize me', 'done' => false],
            ['id' => 2, 'name' => 'Add a database with Compose', 'done' => false],
            ['id' => 3, 'name' => 'Build a CI/CD pipeline', 'done' => false],
            ['id' => 4, 'name' => 'Ship to Kubernetes on AWS', 'done' => false],
        ]);
    }
}

import { Response } from 'express';

export interface ApiResponse<T = unknown> {
  success: boolean;
  message: string;
  data?: T;
  errors?: Record<string, string[]>;
  meta?: Record<string, unknown>;
}

export const sendSuccess = <T>(
  res: Response,
  data: T,
  message = 'Success',
  statusCode = 200,
  meta?: Record<string, unknown>
): Response => {
  const response: ApiResponse<T> = { success: true, message, data };
  if (meta) response.meta = meta;
  return res.status(statusCode).json(response);
};

export const sendError = (
  res: Response,
  message: string,
  statusCode = 400,
  errors?: Record<string, string[]>
): Response => {
  const response: ApiResponse = { success: false, message };
  if (errors) response.errors = errors;
  return res.status(statusCode).json(response);
};

export const sendCreated = <T>(
  res: Response,
  data: T,
  message = 'Created successfully'
): Response => sendSuccess(res, data, message, 201);

export const sendUnauthorized = (
  res: Response,
  message = 'Unauthorized'
): Response => sendError(res, message, 401);

export const sendForbidden = (
  res: Response,
  message = 'Forbidden'
): Response => sendError(res, message, 403);

export const sendNotFound = (
  res: Response,
  message = 'Resource not found'
): Response => sendError(res, message, 404);

export const sendInternalError = (
  res: Response,
  message = 'Internal server error'
): Response => sendError(res, message, 500);

export default {
  sendSuccess,
  sendError,
  sendCreated,
  sendUnauthorized,
  sendForbidden,
  sendNotFound,
  sendInternalError,
};

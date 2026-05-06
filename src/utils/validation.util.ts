import { Request, Response, NextFunction } from 'express';
import { validationResult, ValidationChain } from 'express-validator';
import { sendError } from './response.util';

/**
 * Middleware factory: runs validation chains then checks for errors.
 */
export const validate = (chains: ValidationChain[]) => {
  return async (
    req: Request,
    res: Response,
    next: NextFunction
  ): Promise<void> => {
    await Promise.all(chains.map((chain) => chain.run(req)));

    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      const grouped: Record<string, string[]> = {};
      for (const err of errors.array()) {
        const field = (err as { path?: string; param?: string }).path
          || (err as { path?: string; param?: string }).param
          || 'general';
        if (!grouped[field]) grouped[field] = [];
        grouped[field].push(err.msg);
      }
      sendError(res, 'Validation failed', 422, grouped);
      return;
    }

    next();
  };
};

export default { validate };
